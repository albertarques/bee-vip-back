<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\EntrepreneurshipsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\PaymentMethodsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\RoleAsignmentsController;

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

Route::controller(CommentsController::class)->group(function () {

    // Comentarios
    Route::get('comments', [CommentsController::class, 'index']);
    Route::post('comment', [CommentsController::class, 'store'])->middleware('auth.entrepreneurships');
    Route::get('comment/{id}', [CommentsController::class, 'show']);
    Route::put('comment/{id}', [CommentsController::class, 'update'])->middleware('auth.entrepreneurships');
    Route::delete('comment/{id}', [CommentsController::class, 'destroy'])->middleware('auth.entrepreneurships');
});

Route::controller(UsersController::class)->group(function () {

    // Usuarios
    // Route::get('users', [UsersController::class, 'index']);
    Route::post('user', [UsersController::class, 'store'])->middleware('auth.users');
    Route::get('user/{id}', [UsersController::class, 'show'])->middleware('auth.users');
    Route::put('user/{id}', [UsersController::class, 'update'])->middleware('auth.users');
    Route::delete('user/{id}', [UsersController::class, 'destroy'])->middleware('auth.users');
});

Route::controller(OrdersController::class)->group(function () {

    // Ordenes
    // Route::get('users', [OrdersController::class, 'index']);
    Route::post('order', [OrdersController::class, 'store'])->middleware('auth.orders');
    Route::get('order/{id}', [OrdersController::class, 'show'])->middleware('auth.orders');
    Route::put('order/{id}', [OrdersController::class, 'update'])->middleware('auth.orders');
    Route::delete('order/{id}', [OrdersController::class, 'destroy'])->middleware('auth.orders');
});

Route::controller(OrderDetailsController::class)->group(function () {

    // Detalles de la orden
    // Route::get('users', [OrderDetailsController::class, 'index']);
    Route::post('order_detail', [OrderDetailsController::class, 'store'])->middleware('auth.order_details');
    Route::get('order_detail/{id}', [OrderDetailsController::class, 'show'])->middleware('auth.order_details');
    Route::put('order_detail/{id}', [OrderDetailsController::class, 'update'])->middleware('auth.order_details');
    Route::delete('order_detail/{id}', [OrderDetailsController::class, 'destroy'])->middleware('auth.order_details');
});

Route::controller(PaymentMethodsController::class)->group(function () {

    // Métodos de pago
    Route::get('payment_methods', [PaymentMethodsController::class, 'index']);
    Route::post('payment_method', [PaymentMethodsController::class, 'store'])->middleware('auth.paymentMethods');
    Route::get('payment_method/{id}', [PaymentMethodsController::class, 'show']);
    Route::put('payment_method/{id}', [PaymentMethodsController::class, 'update'])->middleware('auth.paymentMethods');
    Route::delete('payment_method/{id}', [PaymentMethodsController::class, 'destroy'])->middleware('auth.paymentMethods');
});

Route::post('/payments', [PaymentController::class, 'charge']);

Route::controller(RolesController::class)->group(function () {

    // Roles
    Route::get('roles', [RolesController::class, 'index']);
    Route::post('role', [RolesController::class, 'store'])->middleware('auth.entrepreneurships');
    Route::get('role/{id}', [RolesController::class, 'show']);
    Route::put('role/{id}', [RolesController::class, 'update'])->middleware('auth.entrepreneurships');
    Route::delete('role/{id}', [RolesController::class, 'destroy'])->middleware('auth.entrepreneurships');
});

Route::controller(RoleAsignmentsController::class)->group(function () {

    // Asignación de roles
    Route::get('roleAssignments', [RoleAsignmentsController::class, 'index']);
    Route::post('roleAssignment', [RoleAsignmentsController::class, 'store'])->middleware('auth.roleAssignments');
    Route::get('roleAssignment/{id}', [RoleAsignmentsController::class, 'show']);
    Route::put('roleAssignment/{id}', [RoleAsignmentsController::class, 'update'])->middleware('auth.roleAssignments');
    Route::delete('roleAssignment/{id}', [RoleAsignmentsController::class, 'destroy'])->middleware('auth.roleAssignments');
});
