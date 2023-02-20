<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('register', 'App\Http\Controllers\AuthController@register');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');

});

Route::controller(CategoriesController::class)->group(function () {

    // Categorías
    Route::get('categories', [CategoriesController::class, 'index']);
    Route::post('category', [CategoriesController::class, 'store'])->middleware('auth.entrepreneurships');
    Route::get('category/{id}', [CategoriesController::class, 'show']);
    Route::put('category/{id}', [CategoriesController::class, 'update'])->middleware('auth.entrepreneurships');
    Route::delete('category/{id}', [CategoriesController::class, 'destroy'])->middleware('auth.entrepreneurships');

});
