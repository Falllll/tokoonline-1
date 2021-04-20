<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function registrasi () {
        return view('Admin.registrasi');
    }

    function login () {
        return view('Admin.login');
    }

    function dashboard () {
        return view('Admin.dashboard');
    }
}
