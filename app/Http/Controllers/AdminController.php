<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function registrasi () {
        return view('Admin.registrasi');
    }

    public function login () {
        return view('Admin.login');
    }

    public function postlogin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/dashboard');
        }

        return redirect('/login');
    }

    public function dashboard () {
        return view('Admin.dashboard');
    }
}
