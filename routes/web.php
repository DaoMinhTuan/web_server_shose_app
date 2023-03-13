<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\mail\Mailcontroller;
use App\Http\Controllers\auth\registerController;
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


Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('page.dashboard');
    });
});
Route::get('/login', [LoginController::class, 'get_login_web'])->name('get_login_web');
Route::post('/login', [LoginController::class, 'login_web'])->name('login_web');
Route::get('/register', [RegisterController::class, 'get_register_web'])->name('register_web');
Route::post('/register', [RegisterController::class, 'register_web'])->name('post_register_web');
