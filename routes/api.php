<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Authentication Routes
Route::post('register',[AuthenticationController::class, 'register']);
Route::post('login',[AuthenticationController::class, 'login']);
Route::post('logout',[AuthenticationController::class, 'logout'])
    ->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group( function() {
    Route::apiResource('products', ProductController::class);
    Route::get('getCart', [CartController::class, 'get']);
    Route::post('addCart', [CartController::class, 'add']);
    Route::delete('removeCart', [CartController::class, 'remove']);
});
