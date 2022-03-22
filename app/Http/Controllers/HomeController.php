<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function produk()
    {
        $products = Product::all();
        $product_count = Product::all()->count();
        return view('user.produk.index', compact('products', 'product_count'));
    }

    public function pesanan()
    {
        return view('user.pesanan.index');
    }
}
