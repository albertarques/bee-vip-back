<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\PaymentMethodsController;
// use App\Http\Controllers\RoleAsignmentsController;
use App\Http\Controllers\EntrepreneurshipsController;
use App\Http\Controllers\ModelHasRolesController;

// ** Rutas públicas ******************************************************
Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::post('register', 'App\Http\Controllers\AuthController@register');

Route::controller(EntrepreneurshipsController::class)->group(function () {
    Route::get('entrepreneurships', 'availableIndex');
    Route::get('entrepreneurship/{id}', 'show');
});

Route::controller(UsersController::class)->group(function () {
    Route::get('user/{id}', 'show');
});

Route::controller(CategoriesController::class)->group(function () {
    Route::get('categories', 'index');
    Route::get('category/{id}', 'show');
});


// ** Rutas con Autenticación ******************************************************
Route::controller(AuthController::class)->group(function () {
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');

    // TODO: Añadir lista emprendimientos, estado de los emprendimientos y rol del usuario.
    Route::post('me', 'App\Http\Controllers\AuthController@me');

});

// Rutas con Autorización y Permisos
Route::group(['middleware' => 'auth.jwt'], function () {

    Route::post('image',[ImageController::class, 'imageStore']);

    Route::controller(UsersController::class)->group(function () {
        Route::patch('/user/{id}/update', 'update')->middleware('can:update-user-profile');
        Route::delete('/user/{id}/delete', 'destroy')->middleware('can:delete-user-profile');
        Route::put('/user/update/{id}', 'updateRole')->middleware('can:upgrade-user-role');
    });

    Route::controller(PaymentMethodsController::class)->group(function () {
        Route::post('/paymentmethod/create', 'store')->middleware('can:create-payment-method');
        Route::get('/paymentmethod/{id}/view', 'view')->middleware('can:view-payment-method');
        Route::patch('/paymentmethod/{id}/update', 'update')->middleware('can:update-payment-method');
        Route::delete('/paymentmethod/{id}/delete', 'destroy')->middleware('can:delete-payment-method');
    });

    Route::controller(OrdersController::class)->group(function () {
        Route::post('/order/create', 'store')->middleware('can:create-order');
        Route::get('/order/{id}/view', 'view')->middleware('can:view-order');
    });

    Route::controller(OrderDetailsController::class)->group(function () {
        Route::post('/orderdetail/create', 'store')->middleware('can:create-order-detail');
        Route::get('/orderdetail/{id}/view', 'view')->middleware('can:view-order-detail');
    });

    Route::controller(EntrepreneurshipsController::class)->group(function () {
        Route::post('/entrepreneurship/create', 'store')->middleware('can:create-entrepreneurship');
        Route::patch('/entrepreneurship/{id}/update', 'update')->middleware('can:update-entrepreneurship');
        Route::delete('/entrepreneurship/{id}/delete', 'destroy')->middleware('can:delete-entrepreneurship');
        Route::get('/entrepreneurships/pending', 'pendingIndex')->middleware('can:view-pending-entrepreneurships');

    });

    Route::controller(CommentsController::class)->group(function () {
        Route::post('/entrepreneurship/{id}/comment/create', 'store')->middleware('can:create-comment');
        // Route::patch('/comment/{id}/update', 'update')->middleware('can:update-comment');
        // Route::delete('/comment/{id}/delete', 'destroy')->middleware('can:delete-comment');
    });

    Route::controller(ModelHasRolesController::class)->group(function () {
      Route::patch('/update/user/{id}', 'update')->middleware('can:update-user-role');
      Route::get('/showrole/user/{id}', 'show')->middleware('can:show-user-role');
    });
Route::post('image',[ImageController::class, 'imageStore']);
Route::post('payments',[PaymentController::class, 'process']);

// Usuarios
// Route::controller(UsersController::class)->group(function () {
    // Route::get('users', [UsersController::class, 'index']);
    // Devuelve un usuario y sus emprendimientos.
    // Route::get('user', 'show');
// });

//Categorías
Route::controller(CategoriesController::class)->group(function () {
    Route::get('categories', 'index');
    Route::post('category', 'store');
    Route::get('category/{id}', 'show');
    Route::put('category/{id}', 'update');
    // Route::delete('category/{id}', 'destroy')->middleware('auth.entrepreneurships');
});

});
