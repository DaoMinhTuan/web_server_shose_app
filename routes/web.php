<?php

use App\Http\Controllers\auth\LoginController;
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
    Route::get('/login',[LoginController::class,'get_login_web'])->name('login_web');
});


Route::get('/register', function () {
    return view('auth.register');
})->name('register');
