<?php

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

Route::post('users', 'App\Http\Controllers\AuthController@cadastro');
Route::post('login', 'App\Http\Controllers\AuthController@login');

Route::middleware('jwt.auth')->group(function(){
    Route::get('users/me','App\Http\Controllers\AuthController@me');

    Route::post('products','App\Http\Controllers\ProductsController@cadastro');
    Route::get('products','App\Http\Controllers\ProductsController@list');
    Route::put('products/{id}','App\Http\Controllers\ProductsController@editar');
});

