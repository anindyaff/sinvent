<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangmasukController;
use App\Http\Controllers\BarangkeluarController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('kategori', KategoriController::class)->middleware ('auth');
Route::resource('barang', barangController::class)->middleware ('auth');
Route::resource('barangmasuk', barangmasukController::class)->middleware ('auth');
Route::resource('barangkeluar', barangkeluarController::class)->middleware ('auth');

Route::get('/login', [LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class,'authenticate']);
Route::post('/logout', [LoginController::class,'logout'])->name('logout');
// Route::get('/logout', [LoginController::class,'logout']);

Route::post('register', [RegisterController::class,'store']);
Route::get('/register', [RegisterController::class,'create']);