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
  Route::get('entrepreneurships', 'index_available');                       //OK
  Route::get('entrepreneurship/{id}', 'show');                              //OK
});

Route::controller(UsersController::class)->group(function () {
  Route::get('user/{id}', 'show');                                          //OK
});

Route::controller(CategoriesController::class)->group(function () {
  Route::get('categories', 'index');                                        //OK
  Route::get('category/{id}', 'show');                                      //OK
});

Route::controller(CommentsController::class)->group(function () {
  Route::get('comment/{id}', 'show');                                       //OK
});

Route::post('image', [ImageController::class, 'imageStore']);
