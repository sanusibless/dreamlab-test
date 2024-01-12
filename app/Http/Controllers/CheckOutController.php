<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Mail\OrderSuccessMail;
use App\Notifications\OrderNotification;
use App\Notifications\OrdersNotification;

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
        
        foreach(User::findOrFail(auth()->user()->id)->carts as $cart) {
            Order::create([
                'order_id' => $order['id'],
                'product_id' => $cart->product_id,
                'user_id' => $cart->user_id,
                'quantity' => $cart->quantity
            ]);

            $cart->delete();
        }
            Notification::route('mail', $user_email)->notify(new OrdersNotification($order));
                  
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

    public function test()
    {
        $user = auth()->user()->email;
         $order = [
            'id' => rand(4000, 10000000),
            'status' => 'success',
            'reference' => rand(4000, 10000000),
            'amount' => 200000,
            'time' => date('M-D-Y')
        ];
        Notification::route('mail', $user)->notify(new OrdersNotification($order));
    }
}
