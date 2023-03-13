<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth.jwt'])->group(function () {
  Route::post('logout', 'App\Http\Controllers\AuthController@logout');
  Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
  Route::post('me', 'App\Http\Controllers\AuthController@me');
});
