<?php

namespace App\Http\Controllers;

use Auth;
use Alert;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\Pesanandetail;
use illuminate\Support\Str;




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
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
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
        $barangs = Barang::all();
        return view('admin.barang', compact(['barangs']));
    }

    public function pesanan () {
        $pesanans = Pesanan::all();
        return view('admin.pesanan', compact(['pesanans']));
    }

    public function detail () {
        $pesanandetails = Pesanandetail::all();
        return view('admin.detail', compact(['pesanandetails']));
    }

    public function user () {
        $users = User::all();
        return view('admin.user', compact(['users']));
    }

    // CRUD
    public function create(){
        return view('admin.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'keterangan' => 'required',
            'gambar' => 'required|mimes:png,jpg,jpeg|max:5048'

        ]);

        $newImageName = time() . '-' . $request->name . '.' . $request->gambar->extension();

        $request->gambar->move(public_path('img'), $newImageName);

        $barang = Barang::create([
            'nama_barang' => $request->input('nama_barang'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
            'keterangan' => $request->input('keterangan'),
            'gambar' => $newImageName
        ]);

        alert()->success('Data barang berhasil ditambahkan', 'Berhasil');
        return redirect ('/barang');
    }

    public function edit($id){
        $barang = Barang::find($id);
        return view('admin.edit', compact(['barang']));
    }

    public function update(Request $request, $id){
        $barang = Barang::find($id);
        $barang->update($request->all());
        alert()->success('Data barang berhasil diubah', 'Berhasil');
        return redirect ('/barang');
    }

    public function delete($id){
        $barang = Barang::find($id);
        $barang->delete();

        alert()->success('Data berhasil dihapus', 'Berhasil');
        return redirect('/barang');
    }

    public function deletedetail($id){
        $pesanandetail = Pesanandetail::find($id);
        $pesanandetail->delete();

        alert()->success('Data berhasil dihapus', 'Berhasil');
        return redirect('/detail');
    }

    public function deletepesanan($id){
        $pesanan = Pesanan::find($id);
        $pesanan->delete();

        alert()->success('Data berhasil dihapus', 'Berhasil');
        return redirect('/detail');
    }

    // public function deleteuser($id){
    //     $user = User::find($id);
    //     $user->delete();

    //     alert()->success('Data berhasil dihapus', 'Berhasil');
    //     return redirect('/detail');
    // }


}
