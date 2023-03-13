<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrepreneurshipsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\UsersController;

Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::post('register', 'App\Http\Controllers\AuthController@register');

Route::controller(EntrepreneurshipsController::class)->group(function () {
  Route::get('entrepreneurships', 'index_available');
  Route::get('entrepreneurship/{id}', 'show');
});

Route::controller(UsersController::class)->group(function () {
  Route::get('user/{id}', 'show');
});

Route::controller(CategoriesController::class)->group(function () {
  Route::get('categories', 'index');
  Route::get('category/{id}', 'show');
});

Route::controller(CommentsController::class)->group(function () {
  Route::get('comment/{id}', 'show')->middleware('can:show-comment');
});

Route::post('image', [ImageController::class, 'imageStore']);
