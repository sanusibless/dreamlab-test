<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;


class CartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        
        if($request->user()) {
            session([
                'cart' => Cart::where('user_id', auth()->user()->id)->get()->toArray()
            ]);

            session([
                'order' => Order::where('user_id', auth()->user()->id)->where('status','pending')->get()->toArray()
            ]);

        }
        return $next($request);
    }
}
