<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => [ 'api' ]], function () { // auth:sanctum is the token
    Route::post('/users/login', [UserController::class, 'Login']); // login
}); // end of group

Route::group(['middleware' => [ 'auth:sanctum' ]], function () { // auth:sanctum is the token
    Route::get('products/{categorId}/{searchKey?}', [ProductController::class,'index']);
    Route::get('categories/{subCategories?}', [CategoryController::class,'index']);
    Route::get('carts', [CartController::class,'index']);
    Route::post('carts', [CartController::class,'store']);
    Route::put('carts/{cart}', [CartController::class,'update']);
    Route::delete('carts/{cart}', [CartController::class,'destroy']);
    Route::post('orders', [OrderController::class,'store']);
    Route::post('/users/logout', [UserController::class ,'logout']); // logout
}); // end of group
