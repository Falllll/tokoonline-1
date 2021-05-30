<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HistoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/registrasi', [AdminController::class, 'registrasi'])->name('registrasi');
Route::post('/daftar', [AdminController::class, 'daftar'])->name('daftar');
Route::get('/login', [AdminController::class, 'login'])->name('login');
Route::post('/postlogin', [AdminController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth','ceklevel:admin']], function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard'); 
    Route::get('/barang', [AdminController::class, 'barang'])->name('barang');
    Route::get('/pesanan', [AdminController::class, 'pesanan'])->name('pesanan');
    Route::get('/detail', [AdminController::class, 'detail'])->name('detail');
    Route::get('/create', [AdminController::class, 'create']);
    Route::post('/create', [AdminController::class, 'store']);
    Route::get('/edit/{id}', [AdminController::class, 'edit']);
    Route::put('/barang/{id}', [AdminController::class, 'update']);
    Route::delete('/barang/{id}', [AdminController::class, 'delete']);
    Route::delete('/detail/{id}', [AdminController::class, 'deletedetail']);
    Route::delete('/pesanan/{id}', [AdminController::class, 'deletepesanan']);
    Route::get('/user', [AdminController::class, 'user']);
    // Route::delete('/user/{id}', [AdminController::class, 'deleteuser']);
});

Route::group(['middleware' => ['auth','ceklevel:admin,pelanggan']], function(){
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/pesan/{id}', [PesanController::class, 'pesan']);
    Route::post('/pesan/{id}', [PesanController::class, 'kirim']);
    Route::get('/checkout', [PesanController::class, 'checkout']);
    Route::delete('/checkout/{id}', [PesanController::class, 'delete']);
    Route::get('/konfirmasi-check-out', [PesanController::class, 'konfirmasi']);
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/profile', [ProfileController::class, 'update']);
    Route::get('/history', [HistoryController::class, 'index']);
    Route::get('/history/{id}', [HistoryController::class, 'detail']);
});



