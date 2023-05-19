<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\page\BranchController as pageBranch;
use App\Http\Controllers\mail\Mailcontroller;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\page\ProductController as pageProduct;
use App\Http\Controllers\page\OderController as pageOder;

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

    Route::get('/dashboard', function () {
        return view('page.dashboard');
    })->name('dashboard');

    Route::resource('Products', pageProduct::class)->names('product');
    Route::resource('brands', pageBranch::class)->names('brands');
    Route::get('/list_oder',[pageOder::class,'index'])->name('list_oder');
    Route::get('/get_sizes/{id}',[pageProduct::class,'get_size'])->name('get_sizes');
    Route::post('/get_sizes',[pageProduct::class,'update_size'])->name('update_size');
    
});


Route::get('/login', [LoginController::class, 'get_login_web'])->name('get_login_web');
Route::get('/', [LoginController::class, 'get_login_web']);
Route::post('/login', [LoginController::class, 'login_web'])->name('login_web');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');