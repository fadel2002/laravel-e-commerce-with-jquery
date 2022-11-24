<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/shop/detail/{id}', [ShopController::class, 'detail'])->name('shop.detail');
    // Route::get('shop/produk', [ShopController::class, 'getMoreData'])->name('shop.get-more-data');
    // Route::get('shop/search-on-type', [ShopController::class, 'searchOnType'])->name('searchOnType');
    // Route::get('shop/search', [ShopController::class, 'search'])->name('shop.search');
    Route::get('shop/search-ajax', [ShopController::class, 'searchAjax'])->name('shop.search-ajax');
    Route::get('shop/category', [ShopController::class, 'selectCategories'])->name('shop.select-categories');
    Route::post('shop/add-to-cart-ajax', [ShopController::class, 'addToCartAjax'])->name('shop.add-to-cart-ajax');
    Route::post('shop/update-cart-ajax', [ShopController::class, 'updateCart'])->name('shop.update-cart');
    Route::post('shop/delete-item-ajax', [ShopController::class, 'deleteItem'])->name('shop.delete-item');
    Route::get('shop/checkout', [ShopController::class, 'checkout'])->name('shop.checkout');
    Route::get('shop/cart', [ShopController::class, 'cart'])->name('shop.cart');
    Route::get('shop/history', [ShopController::class, 'history'])->name('shop.history');
});

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::get('/tes', [TesController::class, 'index'])->name('tes');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';