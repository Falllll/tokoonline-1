<?php

namespace App\Http\Controllers;

use Auth;
Use Alert;
use Illuminate\Http\Request;
use App\Models\User;
use illuminate\Support\Str;
use App\Models\Barang;

class HomeController extends Controller
{
    function home () {
        $barangs = Barang::paginate(20);
        return view('index', compact('barangs'));

    }

    
}
