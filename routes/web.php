<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckOutController;
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
    return view('index');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name("about");

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/shop', [ProductController::class, 'all'] )->name('products');
Route::get('/load/{num}', [ProductController::class, 'load'] );
Route::get('/single-item/{product}', [ProductController::class, 'single'])->name('product');

Route::middleware(['auth'])->group(function () {
    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart-index');
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
    Route::delete('/remove-item/{cart}', [CartController::class, 'removeItem'])->name('remove-item');
    Route::put('/increase/{cart}', [CartController::class, 'increase'])->name('cart-increase');
    Route::put('/decrease/{cart}', [CartController::class, 'decrease'])->name('cart-decrease');
    Route::delete('/cart-clear/{user}', [CartController::class, 'clear'])->name('cart-clear');

    // Payment
    Route::get('/checkout',[ CheckOutController::class, 'index'])->name('checkout');
    Route::post('/pay',[ CheckOutController::class, 'pay'])->name('pay');
    Route::get('/mail',[ CheckOutController::class, 'test'])->name('test');
    Route::get('/order/confirmation/{reference?}',[CheckOutController::class, 'payCallback'])->name('callback_url');

});

//Auth Route
Route::name('user.')->group(function () {
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'store'])->name('store');
    Route::post('/authenticate', [UserController::class, 'authenticate'])->name('authenticate');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});
