<?php

use App\Http\Controllers\HomeController;
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
    return view('welcome');
});

Route::get('/csrf', function () {
    return csrf_token();
});




Route::get('/produk', [HomeController::class, 'produk'])->name('produk');
Route::get('/pesanan', [HomeController::class, 'pesanan'])->name('pesanan');
Route::get('/getStagingCart', [HomeController::class, 'getStagingCart'])->name('getStagingCart');
Route::get('/getCart', [HomeController::class, 'getCart'])->name('getCart');
Route::post('/store_cart', [HomeController::class, 'storeCart'])->name('store_cart');
Route::post('/remove_cart', [HomeController::class, 'removeCart'])->name('remove_cart');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
