<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\ContactController;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return inertia('Home/Index');
})->name('home');

Route::get('/about', function () {
    return inertia('Home/About');
})->name("about");

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'storeContact'])->name('contact.store');

Route::get('/products', [ProductController::class, 'index'] )->name('products');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('product');
Route::get('/products/category/{category:name}/subcategory/{sub_category:name}', [ProductController::class, 'category'])->name('products-category');

Route::get('/load/{num}', [ProductController::class, 'load'] );
Route::get('/categories', [ProductController::class, 'seedCategory']);


Route::middleware(['auth'])->group(function () {
    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart-index');
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
    Route::get('/remove-item/{cart}', [CartController::class, 'removeItem'])->name('remove-item');
    Route::put('/increase/{cart}', [CartController::class, 'increase'])->name('cart-increase');
    Route::put('/decrease/{cart}', [CartController::class, 'decrease'])->name('cart-decrease');
    Route::delete('/cart-clear/{user}', [CartController::class, 'clear'])->name('cart-clear');

    // Payment Routes
    Route::get('/checkout', [ CheckOutController::class, 'index'])->name('checkout');
    Route::post('/pay', [ CheckOutController::class, 'pay'])->name('pay');
    Route::get('/mail', [ CheckOutController::class, 'test'])->name('test');
    Route::get('/order/confirmation/{reference?}',[CheckOutController::class, 'payCallback'])->name('callback_url');

    //Order Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('view-order');

    Route::get('/payments', [PaymentController::class, 'index'])->name('payment');

});

//Auth Route
Route::name('user.')->group(function () {
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'store'])->name('store');
    Route::post('/authenticate', [UserController::class, 'authenticate'])->name('authenticate');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});


?>
