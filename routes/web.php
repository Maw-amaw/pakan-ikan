<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhController;
use App\Http\Controllers\TempController;
use App\Http\Controllers\PakanController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\PengunaController;
use App\Http\Controllers\AlatController;
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


// login
Route::get('/', [PengunaController::class, 'index'])->name('login');
Route::post('/login', [PengunaController::class, 'login'])->name('login');
Route::get('/logout', [PengunaController::class, 'logout'])->name('logout');
Route::get('/error', [PengunaController::class, 'eror'])->name('error');
Route::get('/admin', [PengunaController::class, 'admin'])->name('admin');
// admin
Route::get('/pagedashbord', [PengunaController::class, 'page'])->name('admin');
Route::get('/alat', [PengunaController::class, 'alat'])->name('alat');
Route::post('/addalat', [AlatController::class, 'addalat'])->name('addalat');
Route::get('/admin/editdata/{id}', [AlatController::class, 'edit'])->name('admin.editdata');
Route::put('/admin/editdata/{id}', [AlatController::class, 'update'])->name('admin.updatedata');
Route::get('/akun', [PengunaController::class, 'akun'])->name('akun');
Route::post('/adduser', [AlatController::class, 'adduser'])->name('adduser');
Route::get('/admin/editakun/{id}', [AlatController::class, 'editAakun'])->name('admin.editakun');
Route::put('/admin/editakun/{id}', [AlatController::class, 'updateakun'])->name('admin.updateakun');
Route::delete('/admin/{id}', [AlatController::class, 'delete'])->name('admin.delete');
Route::delete('/admin/akun/{id}', [AlatController::class, 'deleteakun'])->name('admin.deleteakun');
Route::get('/detail/{alat}', [PengunaController::class, 'show'])->name('detail');
// user
Route::get('/user', [PhController::class, 'index'])->name('dashbord');
Route::get('/pkn', [PhController::class, 'pakan'])->name('dashbord2');
Route::get('/Temp', [TempController::class, 'index'])->name('Temp');
Route::get('/wkt', [SensorController::class, 'wkt'])->name('wkt');
// Route::get('/Temp', [TempController::class, 'temp'])->name('Temp');

// test waktu
Route::get('/waktu', [PakanController::class, 'waktu'])->name('waktu');
Route::post('/store', [PakanController::class, 'store'])->name('store');

// data waktu pakan
Route::put('/update-waktu/{id}', [PakanController::class, 'updateWaktu'])->name('update-waktu');
Route::put('/update-waktu2/{id}', [PakanController::class, 'updateWaktu2'])->name('update-waktu2');
Route::put('/update-waktu3/{id}', [PakanController::class, 'updateWaktu3'])->name('update-waktu3');

Route::get('/pakan', [PakanController::class, 'index'])->name('pakan');
Route::get('/pakan2', [PakanController::class, 'index2'])->name('pakan2');

Route::get('/ph', [SensorController::class, 'index'])->name('ph');
// Route::get('/ph', [PhController::class, 'store']);
Route::get('/post/{slug}', [PostController::class, 'show']);

// Rute untuk menampilkan form update 'Pakan'
Route::get('/pakan/{id}/edit', [PakanController::class, 'edit'])->name('pakan.edit');

// // ssid dan password
// Route::get('/wifi/{alat}', [AlatController::class, 'wifi'])->name('wifi');

