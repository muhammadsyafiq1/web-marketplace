<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductUserController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransactionUserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shopping-history', [HomeController::class, 'shoppingHistory'])->name('shopping.history');
Route::get('categories', [CategoryProductController::class, 'index'])->name('category.product');
Route::get('categories/{id}', [CategoryProductController::class, 'productByCategory'])->name('product.category');
Route::get('detail/{id}', [HomeController::class, 'detail'])->name('detail');
Route::post('add/cart', [HomeController::class, 'addToCart'])->name('add.to.cart');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/cart/{id}', [CartController::class, 'deleteCart'])->name('delete.cart');
Route::post('/checkout', [CheckoutController::class, 'proccessCheckout'])->name('proccess.checkout');

Route::group(['middleware' => ['auth','admin']], function () {
    Route::get('/dashboard-admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::resource('product', App\Http\Controllers\ProductController::class);
    Route::resource('category', App\Http\Controllers\CategoryController::class);
    Route::resource('color', App\Http\Controllers\ColorController::class);
    Route::resource('size', App\Http\Controllers\SizeController::class);
    Route::get('product-variant/{id}', [ProductVariantController::class, 'index'])->name('product-variant');
    Route::post('product-variant/store', [ProductVariantController::class, 'store'])->name('product-variant.store');
    Route::get('product-variant/{id}/delete', [ProductVariantController::class, 'delete'])->name('product-variant.delete');
    Route::resource('transaction', App\Http\Controllers\TransactionController::class);
    Route::get('galleries/{id}/delete', [ProductVariantController::class, 'deleteImage'])->name('galleries.delete-image');
    Route::resource('banner', \App\Http\Controllers\BannerController::class);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard-user', [DashboardUserController::class, 'index'])->name('user.dashboard');
    Route::resource('products', \App\Http\Controllers\ProductUserController::class);
    Route::get('product-image/{id}/delete', [ProductUserController::class, 'removeImage'])->name('remove.image');
    Route::post('product/variant', [ProductUserController::class, 'addVariant'])->name('add.variant');
    Route::resource('galleries', App\Http\Controllers\GalleryController::class);
    Route::get('transactions-user', [TransactionUserController::class, 'index'])->name('transaction.user');
    Route::get('transactions/{id}/detail', [TransactionUserController::class, 'detail'])->name('transaction.detail');
    Route::post('transactions/{id}/update', [TransactionUserController::class, 'update'])->name('transaction.update');
    Route::get('store-setting', [SettingController::class, 'storeSetting'])->name('store.setting');
    Route::post('store-setting-update/{redirect}', [SettingController::class, 'storeUpdate'])->name('store.update');
    Route::get('account', [SettingController::class, 'account'])->name('account');
});


Auth::routes();
