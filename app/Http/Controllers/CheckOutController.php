<?php

namespace App\Http\Controllers;

use App\Jobs\EmailNotificationJob;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Mail\OrderSuccessMail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Notifications\OrderNotification;
use App\Notifications\OrdersNotification;
use Illuminate\Support\Facades\Notification;

class CheckOutController extends Controller 
{
    public function index(Request $request)
    {
        $total = 0;
        $carts = Cart::where('user_id', $request->user()->id)->addSelect([ 
            'price' => Product::select('price')->whereColumn('id','carts.product_id')
        ])->get()->toArray();

        foreach ($carts as $cart) {
            $cart['total'] = $cart['quantity'] * $cart['price'];
            $total += $cart['total'];
        }

        return view('checkout', compact('total'));
    }

    public function pay(Request $request)
    {
        
        $data = $request->validate([
            'email' => 'required|email',
            'amount' => 'required|integer',
            'callback_url' => route('callback_url')
        ]);

        $data['amount'] = $data['amount'] * 100;
        $data['subaccount'] = config('paystack.sub_account');
        $data['split_code'] = config('paystack.split_code');

        $pay = $this->initiatePayment($data);

        $details = $pay->json();

        if(!$details['status']) {

            return back()->withError($details['message']);
        }

        return redirect($details['data']['authorization_url']);
    }

    public function payCallback(Request $request)
    {

        $response = $this->verifyPayment(request('reference'));

        $details = $response->object()->data;
        
        if($details->status === 'success') {
           $order = [
            'id' => $details->id,
            'status' => $details->status,
            'reference' => $details->reference,
            'amount' => $details->amount / 100,
            'time' => $details->paidAt
           ];
        
            $user_email = $request->user()->email;
            $total = 0;
            foreach(User::findOrFail(auth()->user()->id)->carts as $cart) {
                $total += $cart->price * $cart->quantity;
                OrderItem::create([
                    'order_id' => $order['id'],
                    'product_name' => $cart->product_name,
                    'product_id' => $cart->product_id,
                    'price' => $cart->price,
                    'quantity' => $cart->quantity,
                ]);

                $cart->delete();
            }

            Order::create([
                'order_id' => $order['id'],
                'user_id' => $request->user()->id,
                'total_amount' => $total
            ]);

            Payment::create([
                'reference' => $order['reference'],
                'amount' => $order['amount'],
                'order_id' => $order['id'],
                'user_id' => auth()->user()->id,
                'status' => $order['status']
            ]);

            dispatch(new EmailNotificationJob(request()->user(), $order))->delay(now()->addMinutes(2));

            return view('order.success');
        } else {
            return view('order.error');
        }
    }

    private function initiatePayment($data)
    {
        $url = "https://api.paystack.co/transaction/initialize";

        return $result = Http::withHeaders([
            'Authorization' => 'Bearer '. env('PAYSTACK_SECRET_KEY'),
            'Content-Type' => 'application\json'
        ])->post($url,$data);
    }

    private function verifyPayment($reference)
    {
        $url = "https://api.paystack.co/transaction/verify/" . $reference;

        return $result = Http::withHeaders([
            'Authorization' => 'Bearer '. env('PAYSTACK_SECRET_KEY'),
            'Cache-Control' => 'no-cache'
        ])->get($url);
    }
}
