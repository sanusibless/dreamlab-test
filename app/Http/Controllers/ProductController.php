<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;

class ProductController extends Controller
{
    private $string;

    public function __construct($string)
    {
        $this->string = $string;
    }

    public function index(Request $request)
    {
        $search = $request->query('search');

        if($search) {
            return view('products', [
                'products' => Product::filter($search)->paginate()
            ]);
        }

        return view('products', [
            'products' => Product::paginate(5),
            'categories' => Category::all(),
        ]);

    }

    public function category(Category $category, SubCategory $sub_category)
    {
        return view('products', [
            'categories' => Category::all(),
            'products' => Product::category($category->id, $sub_category->id)->paginate(5)
        ]);
    }

    public function show(Product $product)
    {
        return view('product', compact('product'));
    }

    public function load(Request $request, $num)
    {
        for($i = 1; $i <= $num; $i++){

            Product::updateOrCreate([
                'name' => 'Product ' . $i,
                'image' => 'shop_0' . $i],[
                'price' => ceil(rand(20, 100)),
                'rating' => ceil(rand(2, 5)),
                'category' => rand(1,3),
                'sub_category' => rand(1, 5)
            ]);
        }
        User::create([
            'firstname' => 'Blessing',
            'lastname' => 'Sanusi'],
            [
            'email' => 'Holuwoleh@gmail.com',
            'password' => Hash::make(1234567890)
        ]);

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function seedCategory()
    {
        Category::create([
            'name' => 'gender'
        ]);
        Category::create([
            'name' => 'product'
        ]);
        SubCategory::create([
            'name' => 'male',
            'category_id' => 1,
        ]);
        SubCategory::create([
            'name' => 'female',
            'category_id' => 1,
        ]);
        SubCategory::create([
            'name' => 'bag',
            'category_id' => 2,
        ]);
        SubCategory::create([
            'name' => 'sweather',
            'category_id' => 2,
        ]);
        SubCategory::create([
            'name' => 'glasses',
            'category_id' => 2,
        ]);

        return response()->json([
            'message' => 'success'
        ]);
    }
}
