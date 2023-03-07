<?php

use App\Http\Controllers\api\BrandController;
use App\Http\Controllers\api\ColorController;
use App\Http\Controllers\api\OderController;
use App\Http\Controllers\api\OderDetailController;
use App\Http\Controllers\api\PermissionController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\SizeController;
use App\Http\Controllers\api\ProductDetailController;
use App\Http\Controllers\api\RoleController;
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

Route::resource('users', UserController::class)->names('Users');
Route::resource('products', ProductController::class)->names('Products');
Route::resource('sizes', SizeController::class)->names('Sizes');
Route::resource('brands', BrandController::class)->names('Brands');
Route::resource('product_detail', ProductDetailController::class)->names('Product_Detail');
Route::resource('oders', OderController::class)->names('Oders');
Route::resource('permissions', PermissionController::class)->names('Permissions');
Route::resource('roles', RoleController::class)->names('Roles');
Route::resource('colors', ColorController::class)->names('Colors');
Route::resource('oderdetail', OderDetailController::class)->names('Oderdetail');