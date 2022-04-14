<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;

Route::post('login', [ApiController::class, 'authenticate']);
Route::post('register', [ApiController::class, 'register']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('logout', [ApiController::class, 'logout']);
    Route::get('get_user', [ApiController::class, 'get_user']);
    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/{id}', [ProductController::class, 'show']);
    Route::post('create', [ProductController::class, 'store']);
    Route::put('update/{mt5}',  [ProductController::class, 'update']);
    Route::delete('delete/{mt5}',  [ProductController::class, 'destroy']);
});


Route::get('customers', [CustomerController::class, 'getAllStudents']);
Route::get('customers/{id}', [CustomerController::class, 'getStudent']);
Route::post('customers', [CustomerController::class,'createStudent']);
Route::put('customers/{id}', [CustomerController::class, 'updateStudent']);
Route::delete('customers/{id}', [CustomerController::class, 'deleteStudent']);
