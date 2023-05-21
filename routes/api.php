<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('login', [App\Http\Controllers\Api\UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('ijin', [App\Http\Controllers\Api\UserController::class, 'dataIjinInstrukturPribadi']);
    Route::post('store/ijin', [App\Http\Controllers\Api\UserController::class, 'storeIjinInstruktur']);
    //menampilkan data kelas
    Route::get('kelas', [App\Http\Controllers\Api\UserController::class, 'tampilKelas']);
    //menampilkan data jadwal
    Route::get('jadwal', [App\Http\Controllers\Api\UserController::class, 'jadwal']);

    //input data booking_kelas
    Route::POST('booking/kelas', [App\Http\Controllers\Api\UserController::class, 'storeBookingKelas']);

    //input data booking_kelas
    Route::POST('booking/gym', [App\Http\Controllers\Api\UserController::class, 'storeBookingGym']);

});
