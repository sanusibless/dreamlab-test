<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;

class OrderCOntroller extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders; 

        return view('order', compact('orders'));
    }

    public function show($order)
    {

        $order = Order::where('order_id','=', $order)->first(); 
        return view('order_details', compact('order'));
    }
}
