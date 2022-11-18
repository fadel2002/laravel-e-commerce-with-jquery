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

Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('shop/produk', [ShopController::class, 'getMoreData'])->name('get-more-data');
Route::get('shop/search-on-type', [ShopController::class, 'searchOnType'])->name('searchOnType');
Route::get('shop/search', [ShopController::class, 'search'])->name('search');
Route::get('shop/category', [ShopController::class, 'selectCategories'])->name('select-categories');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::get('/tes', [TesController::class, 'index'])->name('tes');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';