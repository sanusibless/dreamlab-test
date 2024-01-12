<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;

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
            'quantity' => 'required|integer' 
        ]);

        $data['user_id'] = $request->user()->id;

        Cart::create($data);

        return back()->with('success', "Item added to cart");
    }

    public function removeItem(Request $request, Cart $cart)
    {
        $cart->delete();

        return back()->with("success", "Item has been removed from cart");
    }

    public function increase(Cart $cart) {
        $cart->quantity += 1;

        $cart->save();

        return back();
    }

    public function decrease(Cart $cart) {
        
        if($cart->quantity == 0) {
            return back();
        }
        $cart->quantity -= 1;

        $cart->save();

        return back();
    }

    public function clear(User $user) 
    {   
        $user->carts()->delete();

        return back()->with("success", "Cart Cleared!");
    }
}
