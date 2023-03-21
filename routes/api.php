<?php

use App\Http\Controllers\api\AddressController;
use App\Http\Controllers\api\BrandController;
use App\Http\Controllers\api\ColorController;
use App\Http\Controllers\api\OderController;
use App\Http\Controllers\api\OderDetailController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\SizeController;
use App\Http\Controllers\api\ProductDetailController;
use App\Http\Controllers\api\RoleController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
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


Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class)->names('Users');
    Route::resource('products', ProductController::class)->names('Products');
    Route::resource('sizes', SizeController::class)->names('Sizes');
    Route::resource('brands', BrandController::class)->names('Brands');
    Route::resource('product_detail', ProductDetailController::class)->names('Product_Detail');
    Route::resource('oders', OderController::class)->names('Oders');
    Route::resource('roles', RoleController::class)->names('Roles');
    Route::resource('colors', ColorController::class)->names('Colors');
    Route::resource('oderdetail', OderDetailController::class)->names('Oderdetail');
    Route::resource('address', AddressController::class)->names('Address');
});

//login and register
Route::get('/login', [LoginController::class, 'get_login'])->name('get_login');
Route::post('/login', [LoginController::class, 'Login'])->name('Login');


Route::get('/register', [RegisterController::class, 'get_api_register'])->name('get_api_register');
Route::post('/register', [RegisterController::class, 'api_register'])->name('api_register');
Route::post('/confrim_account',[RegisterController::class, 'confrim_account'])->name('confrim_account');
