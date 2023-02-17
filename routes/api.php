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

// Route::controller(TodoController::class)->group(function () {
//     Route::get('todos', 'index');
//     Route::post('todo', 'store');
//     Route::get('todo/{id}', 'show');
//     Route::put('todo/{id}', 'update');
//     Route::delete('todo/{id}', 'destroy');
// });
