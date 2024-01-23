<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{
    private $string;

    public function __construct($string)
    {
        $this->string = $string;
    }

    public function index()
    {
        dd(request()->string('type')->upper());
    }

    public function all()
    {
        return view('shop', [
            'products' => Product::all()
        ]);
    }

    public function single(Product $product)
    {
        return view('single-item', compact('product'));
    }

    public function load(Request $request, $num)
    {
        for($i = 1; $i <= $num; $i++){

            Product::create([
                'name' => 'Product ' . $i,
                'image' => 'shop_0' . $i,
                'price' => ceil(rand(20, 100)),
                'rating' => ceil(rand(2, 5))
            ]);
        }
        User::create([
            'firstname' => 'Blessing',
            'lastname' => 'Sanusi',
            'email' => 'Holuwoleh@gmail.com',
            'password' => Hash::make(1234567890)
        ]);

        return response()->json([
            'message' => 'success'
        ]);
    }
}
