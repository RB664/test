<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
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

Route::controller(RegisterController::class)->group(function() {
    Route::get('/register','showRegisterForm')->name('register');
    Route::post('/register','store')->name('register');
});

Route::controller(LoginController::class)->group(function() {
    Route::get('/login','showLoginForm')->name('login');
    Route::post('/login','authenticate')->name('login');
    Route::get('dashboard','dashboard')->name('dashboard');
    Route::post('/logout','logout')->name('logout');
});
