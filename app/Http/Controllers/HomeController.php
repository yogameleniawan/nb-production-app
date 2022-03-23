<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function produk()
    {
        $products = Product::all();
        $product_count = Product::all()->count();
        $carts = Cart::where('status', 'staging')->where('user_id', 1)->get();
        $product_total = 0;
        $product_pay = 0;

        foreach ($carts as $item) {
            $product_total += $item->product_total;
            $product = Product::find($item->product_id);
            $product_pay += $product_total * $product->price;
        }

        $cart_users = DB::table('carts')
            ->leftJoin('products', 'carts.product_id', '=', 'products.id')
            ->where('status', 'staging')->where('user_id', 1)->get();
        return view('user.produk.index', compact('products', 'product_count', 'product_total', 'product_pay', 'cart_users'));
    }

    public function pesanan()
    {
        return view('user.pesanan.index');
    }

    public function getStagingCart()
    {
        $table = Cart::where('status', 'staging')->where('user_id', 1)->get();
        $product_total = 0;
        $product_pay = 0;

        foreach ($table as $item) {
            $product_total += $item->product_total;
            $product = Product::find($item->product_id);
            $product_pay += $product_total * $product->price;
        }
        return response()->json(
            [
                'product_total' => $product_total,
                'product_pay' => $product_pay
            ],
            200
        );
    }

    public function getCart()
    {
        $table = DB::table('carts')
            ->leftJoin('products', 'carts.product_id', '=', 'products.id')
            ->where('status', 'staging')->where('user_id', 1)->get();
        return response()->json(['data' => $table], 200);
    }

    public function storeCart(Request $request)
    {
        $table = new Cart();
        $table->product_total = $request->product_total;
        $table->status = 'staging';
        $table->user_id = 1;
        $table->product_id = $request->product_id;
        $table->save();

        return response()->json($table, 200);
    }

    public function removeCart(Request $request)
    {
        $table = Cart::where('product_id', $request->product_id)
            ->first();
        $table->delete();

        return response()->json($table, 200);
    }
}
