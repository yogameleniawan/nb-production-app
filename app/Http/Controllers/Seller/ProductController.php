<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\UserStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
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
        return view('seller.produk.index', compact('products'));
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
     * Product a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_store = UserStore::where('user_id', Auth::user()->id)->first();
        $table = new Product();
        $table->name = $request->name;

        $image = 'produk' . Str::random(10) . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('/produk'), $image);
        $table->image = '/produk/' . $image;

        $table->price = $request->price;
        $table->store_id = $user_store->store_id;
        $table->save();

        // return response()->json($table, 200);
        return redirect()->route('produk-toko.index');
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
        $user_store = UserStore::where('user_id', Auth::user()->id)->first();
        $table = Product::find($request->id);
        $table->name = $request->name;
        if ($request->file('image')) {
            $image = $request->image;
            $file_name =  time() . "." . $image->getClientOriginalExtension();
            $path = public_path('/produk');
            $image->move($path, $file_name);
            $image_data = '/produk' . $file_name;
            $table->image = $image_data;
        } else {
            $table->image = $table->image;
        }
        $table->price = $request->price;
        $table->store_id = $user_store->store_id;
        $table->save();

        return response()->json($table, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $table = Product::find($request->id);
        $table->delete();

        return response()->json($table, 200);
    }

    public function fetchProduct()
    {
        $user_store = UserStore::where('user_id', Auth::user()->id)->first();
        $data = Product::where('store_id', $user_store->store_id)->get();
        return response()->json(['data' => $data], 200);
    }
}
