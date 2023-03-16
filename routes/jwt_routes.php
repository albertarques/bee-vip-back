<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth.jwt'])->group(function () {
  Route::post('logout', 'App\Http\Controllers\AuthController@logout');    //OK
  Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');  //OK
  Route::post('me', 'App\Http\Controllers\AuthController@me');            //OK
});
