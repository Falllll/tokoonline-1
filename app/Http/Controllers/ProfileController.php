<?php

namespace App\Http\Controllers;
use Auth;
Use Alert;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        $user = User::where('id', Auth::user()->id)->first();

        return view ('profile', compact('user'));
    }
    
    public function update(Request $request){
        $user = User::where('id', Auth::user()->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;
        $user->update();

        alert()->success('Data berhasil diubah', 'Berhasil');
        return redirect ('/profile');
    }
}