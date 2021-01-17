<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CheckoutController;
use App\Http\Controllers\API\IndoRegionController;
use App\Http\Controllers\API\ProductController;
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

Route::get('provinces', [IndoRegionController::class, 'provinces'])->name('api.provinces');
Route::get('regencies/{provinces_id}', [IndoRegionController::class, 'regencies'])->name('api.regencies');
Route::get('districts/{regencies_id}', [IndoRegionController::class, 'districts'])->name('api.districts');

Route::prefix('v1')->group(function(){
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::get('products', [ProductController::class , 'index']);
    Route::get('products/most-picked', [ProductController::class, 'mostPicked']);
    Route::get('product/{count}', [ProductController::class , 'random']);
    Route::get('product/detail/{slug}', [ProductController::class , 'slug']);

    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/{slug}', [CategoryController::class, 'productByCategory']);

    Route::post('cart', [CartController::class, 'addToCart']);
    Route::get('cart/{id}', [CartController::class, 'deleteCart']);

    Route::post('checkout', [CheckoutController::class, 'proccessCheckout']);

    // private
    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('logout', [AuthController::class, 'logout']);
    });
});