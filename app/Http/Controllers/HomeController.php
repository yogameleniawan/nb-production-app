<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Store;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function produk(Request $request)
    {
        if ($request->name != null) {
            $stores = Store::where('slug', $request->name)->first();
            if ($stores == null) {
                return view('user.produk.not-found');
            } else {
                $products = Product::where('store_id', $stores->id)->get();
                $product_count = Product::where('store_id', $stores->id)->count();
                $carts = Cart::where('status', 'staging')->where('user_id', Auth::user()->id)->get();
                $product_total = 0;
                $product_pay = 0;

                foreach ($carts as $item) {
                    $product_total += $item->product_total;
                    $product = Product::find($item->product_id);
                    $product_pay += $product_total * $product->price;
                }

                $cart_users = DB::table('carts')
                    ->leftJoin('products', 'carts.product_id', '=', 'products.id')
                    ->where('status', 'staging')
                    ->where('user_id', Auth::user()->id)->get();
                return view('user.produk.index', compact('products', 'product_count', 'product_total', 'product_pay', 'cart_users'));
            }
        } else {
            return view('user.produk.not-found');
        }
    }

    public function pesanan(Request $request)
    {
        $stores = Store::where('slug', $request->name)->first();
        $products = Product::where('store_id', $stores->id)->get();
        $product_count = Product::where('store_id', $stores->id)->count();
        $carts = Cart::where('status', 'checkout')->where('user_id', Auth::user()->id)->get();
        $product_total = 0;
        $product_pay = 0;

        foreach ($carts as $item) {
            $product_total += $item->product_total;
            $product = Product::find($item->product_id);
            $product_pay += $product_total * $product->price;
        }

        $cart_users = DB::table('carts')
            ->leftJoin('products', 'carts.product_id', '=', 'products.id')
            ->where('status', 'checkout')
            ->where('user_id', Auth::user()->id)->get();
        return view('user.pesanan.index', compact('product_total', 'product_pay', 'cart_users'));
    }

    public function getStagingCart()
    {
        $table = Cart::where('status', 'staging')->where('user_id', Auth::user()->id)->get();
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
            ->where('status', 'staging')->where('user_id', Auth::user()->id)->get();
        return response()->json(['data' => $table], 200);
    }

    public function storeCart(Request $request)
    {
        $cart = Cart::where('product_id', $request->product_id)->where('status', 'staging')->where('user_id', Auth::user()->id)->count();

        if ($cart == 1) {
            $table = Cart::where('product_id', $request->product_id)->where('user_id', Auth::user()->id)->first();
            $table->product_total = $table->product_total + $request->product_total;
            $table->save();
        } else {
            $table = new Cart();
            $table->product_total = $request->product_total;
            $table->status = 'staging';
            $table->user_id = Auth::user()->id;
            $table->product_id = $request->product_id;
            $table->save();
        }

        return response()->json($table, 200);
    }

    public function removeCart(Request $request)
    {
        $table = Cart::where('product_id', $request->product_id)
            ->where('user_id', Auth::user()->id)
            ->first();
        $table->delete();

        return response()->json($table, 200);
    }

    public function getProductSearch(Request $request)
    {
        $store = Store::where('slug', $request->name)->first();
        $data = Product::where('name', 'LIKE', "%$request->keyword%")->where('store_id', $store->id)->get();
        return response()->json(['data' => $data], 200);
    }

    public function checkoutProduct()
    {
        $transaction = new Transaction();
        $transaction->save();
        $affectedRows = Cart::where('status', 'staging')->where('user_id', Auth::user()->id)->update(array('status' => 'checkout', 'transaction_id' => $transaction->id));
        if ($affectedRows) {
            return response()->json(['data' => $affectedRows], 200);
        }
    }
}
