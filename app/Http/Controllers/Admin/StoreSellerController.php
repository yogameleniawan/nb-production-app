<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use App\Models\UserStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreSellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('user_stores')
            ->leftJoin('users', 'user_stores.user_id', '=', 'users.id')
            ->leftJoin('stores', 'user_stores.store_id', '=', 'stores.id')
            ->select('user_stores.id as id', 'user_stores.user_id as user_id', 'user_stores.store_id as store_id', 'users.name as user_name', 'stores.name as store_name')
            ->get();
        $stores = Store::all();
        $users = User::where('role', 'seller')->get();
        return view('admin.store_user.index', compact('data', 'stores', 'users'));
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


        $user_store_count = UserStore::where('user_id', $request->user_id)
            ->count();

        if ($user_store_count == 1) {
            $table = UserStore::where('user_id', $request->user_id)
                ->first();;
            $table->user_id = $request->user_id;
            $table->store_id = $request->store_id;
            $table->save();
        } else {
            $table = new UserStore();
            $table->user_id = $request->user_id;
            $table->store_id = $request->store_id;
            $table->save();
        }

        return response()->json($table, 200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $table = UserStore::find($request->id);
        $table->delete();

        return response()->json($table, 200);
    }

    public function fetchSellerStore()
    {
        $data = DB::table('user_stores')
            ->leftJoin('users', 'user_stores.user_id', '=', 'users.id')
            ->leftJoin('stores', 'user_stores.store_id', '=', 'stores.id')
            ->select('user_stores.id as id', 'user_stores.user_id as user_id', 'user_stores.store_id as store_id', 'users.name as user_name', 'stores.name as store_name')
            ->get();

        return response()->json(['data' => $data], 200);
    }
}
