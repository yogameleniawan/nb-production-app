<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_store = UserStore::where('user_id', Auth::user()->id)->first();
        $products = Product::where('store_id', $user_store->store_id)->get();
        $product_count = Product::where('store_id', $user_store->id)->count();
        $carts = Cart::where('status', 'checkout')->get();
        $product_total = 0;
        $product_pay = 0;

        $carts = DB::table('carts')
            ->leftJoin('transactions', 'carts.transaction_id', '=', 'transactions.id')
            ->leftJoin('products', 'carts.product_id', '=', 'products.id')
            ->leftJoin('stores', 'products.store_id', '=', 'stores.id')
            ->where('products.store_id', $user_store->store_id)
            ->get();

        $transaction = DB::table('carts')
            ->leftJoin('transactions', 'carts.transaction_id', '=', 'transactions.id')
            ->leftJoin('products', 'carts.product_id', '=', 'products.id')
            ->leftJoin('stores', 'products.store_id', '=', 'stores.id')
            ->where('products.store_id', $user_store->store_id)
            ->groupBy('carts.transaction_id')
            ->get();
        $users = User::all();

        foreach ($carts as $item) {
            $product_total += $item->product_total;
        }

        foreach ($carts as $item) {
            $product_pay += $item->product_total * $item->price;
        }

        $cart_users = DB::table('carts')
            ->leftJoin('products', 'carts.product_id', '=', 'products.id')
            ->where('status', 'checkout')
            ->get();

        return view('seller.transaksi.index', compact('products', 'product_count', 'product_total', 'product_pay', 'cart_users', 'transaction', 'users', 'carts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $affectedRows = Cart::where('status', 'checkout')->where('transaction_id', $request->transaction_id)->update(array('status' => 'complete'));
        $transaction = Transaction::find($request->transaction_id);
        $transaction->delete();
        if ($affectedRows) {
            return response()->json(['data' => $affectedRows], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCompleteCart()
    {
        $user_store = UserStore::where('user_id', Auth::user()->id)->first();
        $carts = Cart::where('status', 'checkout')->get();
        $product_total = 0;
        $product_pay = 0;

        $carts = DB::table('carts')
            ->leftJoin('transactions', 'carts.transaction_id', '=', 'transactions.id')
            ->leftJoin('products', 'carts.product_id', '=', 'products.id')
            ->leftJoin('stores', 'products.store_id', '=', 'stores.id')
            ->where('products.store_id', $user_store->store_id)
            ->get();

        foreach ($carts as $item) {
            $product_total += $item->product_total;
        }

        foreach ($carts as $item) {
            $product_pay += $item->product_total * $item->price;
        }

        return response()->json(
            [
                'product_total' => $product_total,
                'product_pay' => $product_pay
            ],
            200
        );
    }

    public function getComplete()
    {
        $user_store = UserStore::where('user_id', Auth::user()->id)->first();
        $carts = DB::table('carts')
            ->leftJoin('transactions', 'carts.transaction_id', '=', 'transactions.id')
            ->leftJoin('products', 'carts.product_id', '=', 'products.id')
            ->leftJoin('stores', 'products.store_id', '=', 'stores.id')
            ->where('products.store_id', $user_store->store_id)
            ->get();

        $transactions = DB::table('carts')
            ->leftJoin('transactions', 'carts.transaction_id', '=', 'transactions.id')
            ->leftJoin('products', 'carts.product_id', '=', 'products.id')
            ->leftJoin('stores', 'products.store_id', '=', 'stores.id')
            ->where('products.store_id', $user_store->store_id)
            ->groupBy('carts.transaction_id')
            ->get();
        $users = User::all();

        return response()->json(['data' => $transactions, 'users' => $users, 'carts' => $carts], 200);
    }
}
