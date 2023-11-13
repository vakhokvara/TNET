<?php

use App\Http\Controllers\Cart\AddProductController;
use App\Http\Controllers\Cart\RemoveProductController;
use App\Http\Controllers\Cart\SetProductQuantityController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\GetCartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', AuthController::class);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/add-product-in-cart', AddProductController::class);
    Route::post('/remove-product-from-cart', RemoveProductController::class);
    Route::post('/set-cart-product-quantity', SetProductQuantityController::class);

    Route::get('/get-user-cart', GetCartController::class);
});
