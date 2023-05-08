<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes();

Route::get('/', function () {
    return view('auth/login');
});


//Route::get('/login', [App\Http\Controllers\HomeController::class, 'login'])->name('login');

Route::post('/account/store', [App\Http\Controllers\UserController::class, 'store'])->name('account.store');

//backend

//dashboard
Route::get('/backend/dashboard',[App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

//users
Route::get('/backend/users',[App\Http\Controllers\UserController::class, 'index'])->name('index.user');
Route::get('/backend/users-create',[App\Http\Controllers\UserController::class, 'create'])->name('create.user');
Route::post('/backend/users-store',[App\Http\Controllers\UserController::class, 'store'])->name('store.user');
Route::get('/backend/users-edit/{id}',[App\Http\Controllers\UserController::class, 'edit'])->name('edit.user');
Route::put('/backend/users-update/{id}',[App\Http\Controllers\UserController::class, 'update'])->name('update.user');
Route::get('/backend/users-destroy/{id}',[App\Http\Controllers\UserController::class, 'destroy'])->name('destroy.user');

//instruktur (admin)
Route::get('/backend/instruktur',[App\Http\Controllers\InstrukturController::class, 'index'])->name('index.instruktur');
Route::get('/backend/instruktur-create',[App\Http\Controllers\InstrukturController::class, 'create'])->name('create.instruktur');
Route::post('/backend/instruktur-store',[App\Http\Controllers\InstrukturController::class, 'store'])->name('store.instruktur');
Route::get('/backend/instruktur-edit/{id}',[App\Http\Controllers\InstrukturController::class, 'edit'])->name('edit.instruktur');
Route::get('/backend/instruktur-show/{id}',[App\Http\Controllers\InstrukturController::class, 'show'])->name('show.instruktur');
Route::put('/backend/instruktur-update/{id}',[App\Http\Controllers\InstrukturController::class, 'update'])->name('update.instruktur');
Route::get('/backend/instruktur-destroy/{id}',[App\Http\Controllers\InstrukturController::class, 'destroy'])->name('destroy.instruktur');

//member (kasir)
Route::get('/backend/member',[App\Http\Controllers\MemberController::class, 'index'])->name('index.member');
Route::get('/backend/member-create',[App\Http\Controllers\MemberController::class, 'create'])->name('create.member');
Route::post('/backend/member-store',[App\Http\Controllers\MemberController::class, 'store'])->name('store.member');
Route::get('/backend/member-edit/{id}',[App\Http\Controllers\MemberController::class, 'edit'])->name('edit.member');
Route::get('/backend/member-show/{id}',[App\Http\Controllers\MemberController::class, 'show'])->name('show.member');
Route::put('/backend/member-update/{id}',[App\Http\Controllers\MemberController::class, 'update'])->name('update.member');
Route::get('/backend/member-destroy/{id}',[App\Http\Controllers\MemberController::class, 'destroy'])->name('destroy.member');
Route::get('member/print', [App\Http\Controllers\MemberController::class, 'printCard'])->name('member.print');

//jadwal (owner)
Route::get('/backend/jadwal-instruktur',[App\Http\Controllers\JadwalController::class, 'index'])->name('index.jadwal');
Route::get('/backend/jadwal-instruktur-create',[App\Http\Controllers\JadwalController::class, 'create'])->name('create.jadwal');
Route::post('/backend/jadwal-instruktur-store',[App\Http\Controllers\JadwalController::class, 'store'])->name('store.jadwal');
Route::get('/backend/jadwal-instruktur-edit/{id}',[App\Http\Controllers\JadwalController::class, 'edit'])->name('edit.jadwal');
Route::get('/backend/jadwal-instruktur-show/{id}',[App\Http\Controllers\JadwalController::class, 'show'])->name('show.jadwal');
Route::put('/backend/jadwal-instruktur-update/{id}',[App\Http\Controllers\JadwalController::class, 'update'])->name('update.jadwal');
Route::get('/backend/jadwal-instruktur-destroy/{id}',[App\Http\Controllers\JadwalController::class, 'destroy'])->name('destroy.jadwal');
//jadwal Harian (owner)
Route::get('/backend/jadwal-harian-instruktur',[App\Http\Controllers\JadwalController::class, 'indexCetak'])->name('index.cetakJadwal');
Route::get('/laporan/{tglawal}/{tglakhir}', [App\Http\Controllers\JadwalController::class, 'review']);
Route::get('jadwal-harian/print', [App\Http\Controllers\JadwalController::class, 'review'])->name('jadwal-harian.print');

