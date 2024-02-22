<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiUserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/user', function (Request $request) {
    return response()->json($request->all());
});

Route::post('/register', [ApiUserController::class, 'register']);
Route::post('/login', [ApiUserController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {
    Route::get('/profile', [ApiUserController::class, 'profile']);
    Route::get('/logout', [ApiUserController::class, 'logout']);
});
