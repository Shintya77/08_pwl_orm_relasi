<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\TampilController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;

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

Route::resource('/mahasiswa', MahasiswaController::class);
Route::get('search', [MahasiswaController::class,'search'])->name('search');
Route::get('mahasiswa/nilai/{nim}', [NilaiController::class, 'index'])->name('mahasiswa.nilai');
Route::resource('/articles', ArticleController::class);
Route::get('/article/cetak_pdf',[ArticleController::class, 'cetak_pdf']);