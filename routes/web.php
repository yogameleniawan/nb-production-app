<?php

use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Seller\CartController;
use App\Http\Controllers\Seller\ProductController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    // return view('welcome');
    return view('auth.register');
});

// Route::get('/csrf', function () {
//     return csrf_token();
// });

Route::middleware(['auth:sanctum', 'verified', 'can:seller'])->group(function () {
    Route::resources([
        'produk-toko' => ProductController::class,
        'transaksi' => CartController::class
    ]);
});

Route::middleware(['auth:sanctum', 'verified', 'can:admin'])->group(function () {
    Route::resources([
        'store' => StoreController::class,
        'user' => UserController::class
    ]);
});

Route::middleware(['auth:sanctum', 'verified', 'can:user'])->group(function () {
    Route::get('/toko', [HomeController::class, 'produk'])->name('produk');
    Route::get('/checkoutProduct', [HomeController::class, 'checkoutProduct'])->name('checkoutProduct');
    Route::post('/getProductSearch', [HomeController::class, 'getProductSearch'])->name('getProductSearch');
    Route::get('/pesanan', [HomeController::class, 'pesanan'])->name('pesanan');
    Route::get('/getStagingCart', [HomeController::class, 'getStagingCart'])->name('getStagingCart');
    Route::get('/getCart', [HomeController::class, 'getCart'])->name('getCart');
    Route::post('/store_cart', [HomeController::class, 'storeCart'])->name('store_cart');
    Route::post('/remove_cart', [HomeController::class, 'removeCart'])->name('remove_cart');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::fallback(function () {
    return view('auth.register');
});
