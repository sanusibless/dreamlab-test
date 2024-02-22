<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function index(Request $request)
    {   
        $carts = Cart::where('user_id', $request->user()->id)->addSelect([ 
            'product_name' => Product::select('name')->whereColumn('id','carts.product_id'),
            'price' => Product::select('price')->whereColumn('id','carts.product_id'),
            'image' => Product::select('image')->whereColumn('id','carts.product_id'),
    ])->get()->toArray();

        return view('cart', compact('carts') );
    }

    public function addToCart(Request $request)
    {

        $data = $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
            'product_name' => 'required|string',
            'price' => 'required|integer'
        ]);

        $data['user_id'] = $request->user()->id;

        Cart::updateOrCreate(
            ['product_id' => $data['product_id'], 'user_id' => $data['user_id']],
            ['price' =>$data['price'],'quantity'=> $data['quantity'], 'product_name' => $data['product_name']]
        );
        
        Alert::success('Success', 'Item added to cart successfully');

        return back();
    }

    public function removeItem(Request $request, Cart $cart)
    {   
        // confirmDelete('Are you sure you want to remove this item from cart');

        $cart->delete();

        Alert::success('Success', 'Item is now removed');

        return back();
    }

    public function increase(Cart $cart) {
        $cart->quantity += 1;

        $cart->save();

        Alert::success('Success', 'Item quantity has increased!');

        return back();
    }

    public function decrease(Cart $cart) {
        
        if($cart->quantity == 1) {
            Alert::warning('Too low', 'You cannot have less than 1 item');

            return back();
        }
        $cart->quantity -= 1;

        $cart->save();

        return back();
    }

    public function clear(User $user) 
    {   
        confirmDelete('Are you sure you want to clear your cart?');

        $user->carts()->delete();

        Alert::success("Success", "Cart Cleared!");

        return back();
    }
}
