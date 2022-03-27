<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use App\Models\UserStore;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarcodeController extends Controller
{
    public function generateBarcode()
    {
        $user_store = UserStore::where('user_id', Auth::user()->id)->first();
        $store = Store::find($user_store->store_id);
        // return view('barcode', compact('store'));
        $pdf = PDF::loadView('barcode', compact('store'));

        return $pdf->download('barcode.pdf');
    }
}
