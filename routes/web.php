<?php

use App\Http\Controllers\Login;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Siswa;
use App\Http\Controllers\Spp;
use App\Http\Controllers\Reset;
use App\Http\Controllers\ForgotPassword;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [Login::class, 'index'])->name('login');
Route::post('/login/proses', [Login::class, 'proses']);
Route::get('/logout', [Login::class, 'logout'])->name('logout');
Route::get('/reset', [Reset::class, 'index']);
Route::get('/register', [Login::class, 'register']);


Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['CekUserLogin:admin']], function () {
        Route::resource('admin', Admin::class);
    });
    Route::group(['middleware' => ['CekUserLogin:siswa']], function () {
        Route::resource('siswa', Siswa::class);
    });
});

Route::get('/pembayaran', [Spp::class, 'index']);
Route::post('/pembayaran/save', [Spp::class, 'save']);
Route::delete('pembayaran/delete/{id}', [Spp::class, 'delete'])->name('pembayaran.delete');
Route::get('pembayaran/edit/{id}', [Spp::class, 'edit'])->name('pembayaran.edit');
Route::put('pembayaran/update/{id}', [Spp::class, 'update'])->name('pembayaran.update');

Route::get('/siswa', [Siswa::class, 'index']);

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');
Route::post('/forgot-password', [ForgotPassword::class, 'forgotPassword'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');
Route::post('/reset-password', [ForgotPassword::class, 'resetPassword'])
    ->middleware('guest')
    ->name('password.update');
