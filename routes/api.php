<?php

use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\SizeController;
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
