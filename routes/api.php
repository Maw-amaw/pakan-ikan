<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\PakanController;
use App\Http\Controllers\AlatController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Route::resource('ph', PhController::class)->only([
//     'destroy', 'show', 'store', 'update'
//  ]);

Route::post('sensor', [SensorController::class, 'store'])->middleware('api');
Route::post('pakan', [PakanController::class, 'store'])->middleware('api');
// Route::post('waktu', [PakanController::class, 'store']);
Route::get('getWaktu', [PakanController::class, 'getWaktu'])->middleware('api');
Route::get('getSensor', [SensorController::class, 'getSensor'])->middleware('api');
Route::get('wkt', [SensorController::class, 'wkt'])->middleware('api');
Route::post('poststatus', [SensorController::class, 'status'])->middleware('api');
// ssid dan password
Route::get('/wifi/{alat}', [AlatController::class, 'wifi']);



// waktu
// Route::post('/atur-waktu', 'SensorController@aturWaktu');
// Route::get('/ambil-waktu', 'SensorController@ambilWaktu');

// Route::post('/set-waktu', 'PakanController@setWaktu');

//  Route::resource('pakanin', PhController::class)->only([
//     'destroy', 'show',  'update', 'store'
// ])->middleware('api');

// Route::post('data', [TempController::class, 'storeData']);
