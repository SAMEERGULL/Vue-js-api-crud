<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Auth routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

//Product routes
Route::get('products', [ProductController::class, 'index'])->middleware('auth:api');
Route::get('products/{product}', [ProductController::class, 'show'])->middleware('auth:api');
Route::post('products', [ProductController::class, 'store'])->middleware('auth:api');
Route::put('products/{product}', [ProductController::class, 'update'])->middleware('auth:api');
Route::delete('products/{product}', [ProductController::class, 'delete'])->middleware('auth:api');