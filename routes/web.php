<?php

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

use App\Http\Controllers\Perpus;
use Illuminate\Support\Facades\Route;

Route::get('/perpus', [Perpus::class, 'index'])->name('index');
Route::delete('/hapus/{id}', [Perpus::class, 'hapus'])->name('hapus');
Route::get('/tambah', [Perpus::class, 'create']);
Route::post('/simpan', [Perpus::class, 'store'])->name('simpan');
Route::get('/edit/{id}', [Perpus::class, 'edit'])->name('edit');
Route::post('/update/{id}', [Perpus::class, 'update'])->name('update');
