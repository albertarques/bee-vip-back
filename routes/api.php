<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\EntrepreneurshipsController;
use App\Http\Controllers\RolesController;

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

Route::controller(EntrepreneurshipsController::class)->group(function () {

    // Emprendimientos
    Route::get('entrepreneurships', [EntrepreneurshipsController::class, 'index']);
    Route::post('entrepreneurship', [EntrepreneurshipsController::class, 'store'])->middleware('auth.entrepreneurships');
    Route::get('entrepreneurship/{id}', [EntrepreneurshipsController::class, 'show']);
    Route::put('entrepreneurship/{id}', [EntrepreneurshipsController::class, 'update'])->middleware('auth.entrepreneurships');
    Route::delete('entrepreneurship/{id}', [EntrepreneurshipsController::class, 'destroy'])->middleware('auth.entrepreneurships');
});

Route::controller(RolesController::class)->group(function () {

    // Roles
    Route::get('roles', [RolesController::class, 'index']);
    Route::post('role', [RolesController::class, 'store'])->middleware('auth.entrepreneurships');
    Route::get('role/{id}', [RolesController::class, 'show']);
    Route::put('role/{id}', [RolesController::class, 'update'])->middleware('auth.entrepreneurships');
    Route::delete('role/{id}', [RolesController::class, 'destroy'])->middleware('auth.entrepreneurships');
});
