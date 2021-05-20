<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use illuminate\Support\Str;
use App\Models\Barang;


class AdminController extends Controller
{
    public function registrasi () {
        return view('Admin.registrasi');
    }

    public function daftar(Request $request){
        
        User::create([
            'name' => $request->name,
            'level' => 'pelanggan', 
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
        ]);

        return view('admin.login');
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

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }

    public function dashboard () {
        return view('Admin.dashboard');
    }


    public function barang () {
        return view('admin.barang');
    }

    public function pesanan () {
        return view('admin.pesanan');
    }

    public function detail () {
        return view('admin.detail');
    }

}
