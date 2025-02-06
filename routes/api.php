<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\schoolController;
use App\Http\Controllers\ProductController;

Route::post('/register', [AuthController::class, 'register']);

Route::get('/products', [ProductController::class, 'index']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/getoneproduct/{id}', [ProductController::class, 'show']);

Route::get('/product/search/{name}', [ProductController::class, 'search']);

//protected routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/updateproduct/{id}', [ProductController::class, 'update']);
    Route::delete('/deleteproduct/{id}', [ProductController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/updateuser/{id}', [AuthController::class, 'updateUser']);

});

//protected routes for school creartion

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/createschools', [schoolController::class, 'store']);});
