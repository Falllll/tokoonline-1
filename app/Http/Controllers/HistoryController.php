<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Pesanandetail;
use App\Models\Barang;
use Auth;
use Alert;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(){
        $pesanans = Pesanan::where('user_id', Auth::user()->id)->where('status', '!=', 0)->get();

        return view('history', compact('pesanans'));
    }

    public function detail($id){
        $pesanan = Pesanan::where('id', $id)->first();
        $pesanan_details = Pesanandetail::where('pesanan_id', $pesanan->id)->get();
       
        return view('pesanan', compact('pesanan','pesanan_details'));
    }
}
