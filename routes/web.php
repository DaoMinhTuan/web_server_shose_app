<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\mail\Mailcontroller;
use App\Http\Controllers\auth\RegisterController;
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

Route::get('/', function () {
    return view('page.dashboard');
});

Route::middleware(['auth'])->group(function () {
});


Route::get('/login',[LoginController::class,'get_login_web'])->name('get_login_web');
Route::post('/login',[LoginController::class,'login_web'])->name('login_web');


Route::get('/register',[RegisterController::class,'get_register_web'])->name('get_web_register');
Route::post('/register',[RegisterController::class,'web_register'])->name('pos_web_register');



Route::get('/send',[Mailcontroller::class,'index'])->name('index');
