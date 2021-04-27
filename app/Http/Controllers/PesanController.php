<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function pesan($id){
        $barang = Barang::where('id', $id)->first();

        return view('pesan', compact('barang'));
    }
}
