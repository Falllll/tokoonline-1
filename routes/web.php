<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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

Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/registrasi', [AdminController::class, 'registrasi'])->name('registrasi');
Route::post('/daftar', [AdminController::class, 'daftar'])->name('daftar');
Route::get('/login', [AdminController::class, 'login'])->name('login');
Route::post('/postlogin', [AdminController::class, 'postlogin'])->name('postlogin');
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard'); 
Route::get('/barang', [AdminController::class, 'barang'])->name('barang');
Route::get('/pesanan', [AdminController::class, 'pesanan'])->name('pesanan');
Route::get('/detail', [AdminController::class, 'detail'])->name('detail');