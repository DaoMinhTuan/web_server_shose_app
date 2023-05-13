<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\OderController;
use App\Http\Controllers\api\RoleController;
use App\Http\Controllers\api\SizeController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\BrandController;
use App\Http\Controllers\api\ColorController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\api\AddressController;
use App\Http\Controllers\api\cartController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\api\OderDetailController;
use App\Http\Controllers\api\ProductDetailController;
use App\Http\Controllers\api\RatingController;

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



    Route::resource('users', UserController::class)->names('Users');
    Route::post('send-otp', [UserController::class,"send_otp"])->name('send_otp');
    
    Route::resource('products', ProductController::class)->names('Products');
    Route::get('products/branch/{id}',[ProductController::class,'get_brach_products'])->name('branch_products');
    Route::get('products/seach/{name}',[ProductController::class,'get_products_name'])->name('name_product');
    Route::get('products/{size}/{id}',[ProductController::class,'get_products_size'])->name('get_products_size');
    
    Route::resource('sizes', SizeController::class)->names('Sizes');
    Route::get('sizes/product/{id}',[SizeController::class,'size_product'])->name('size_product');
    Route::put('sizes/quantity',[SizeController::class,'update_quantity'])->name('update_quantity');
    Route::resource('brands',BrandController::class)->names('brands');

    Route::resource('product_detail', ProductDetailController::class)->names('Product_Detail');
    Route::resource('oders', OderController::class)->names('Oders');
    Route::resource('roles', RoleController::class)->names('Roles');
    Route::resource('colors', ColorController::class)->names('Colors');
    Route::resource('ratings', RatingController::class)->names('ratings');

    Route::resource('oderdetail', OderDetailController::class)->names('Oderdetail');
    Route::get('history/{user}/{status}', [OderDetailController::class,'history_oder'])->name('history_oder');

    Route::resource('address', AddressController::class)->names('Address');
    Route::resource('carts', cartController::class)->names('carts');
    Route::get('get-cars/{user}',[cartController::class,'get_cart_user'])->name('get_carts');

// //login and register

Route::get('/login', [LoginController::class, 'get_login'])->name('get_login');
Route::post('/login', [LoginController::class, 'Login'])->name('Login');


Route::get('/register', [RegisterController::class,'get_api_register'])->name('get_api_register');
Route::post('/register', [RegisterController::class,'api_register'])->name('api_register');
Route::post('/register/admin', [RegisterController::class,'api_admin_register'])->name('api_admin_register');
Route::get('/confrim_account/{token}',[RegisterController::class, 'confrim_account'])->name('confrim_account');
