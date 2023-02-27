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
use App\Http\Controllers\RolesController;
use App\Http\Controllers\RoleAsignmentsController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('register', 'App\Http\Controllers\AuthController@register');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
});

// Usuarios
Route::controller(UsersController::class)->group(function () {
    // Devuelve un usuario y sus emprendimientos.
    Route::get('user', 'show');
});

// Categorías
Route::controller(CategoriesController::class)->group(function () {
    Route::get('categories', 'index');
    Route::post('category', 'store')->middleware('auth.entrepreneurships');
    Route::get('category/{id}', 'show');
    Route::put('category/{id}', 'update')->middleware('auth.entrepreneurships');
    // Route::delete('category/{id}', 'destroy')->middleware('auth.entrepreneurships');
});

// Emprendimientos
Route::controller(EntrepreneurshipsController::class)->group(function () {
    Route::get('entrepreneurships', 'indexAproved');
    Route::get('entrepreneurships_pending', 'indexPending');
    Route::post('entrepreneurship', 'store')->middleware('auth.entrepreneurships');
    Route::get('entrepreneurship/{id}', 'show');
    Route::put('entrepreneurship/{id}', 'update')->middleware('auth.entrepreneurships');
    Route::delete('entrepreneurship/{id}', 'destroy')->middleware('auth.entrepreneurships');
});

// Comentarios
Route::controller(CommentsController::class)->group(function () {
    Route::post('comment', 'store')->middleware('auth.entrepreneurships');
    Route::get('comment/{id}', [CommentsController::class, 'show']);
    Route::put('comment/{id}', [CommentsController::class, 'update'])->middleware('auth.entrepreneurships');
    Route::delete('comment/{id}', [CommentsController::class, 'destroy'])->middleware('auth.entrepreneurships');
});

// Usuarios
Route::controller(UsersController::class)->group(function () {
    Route::post('user', [UsersController::class, 'store'])->middleware('auth.users');
    Route::get('user/{id}', [UsersController::class, 'show'])->middleware('auth.users');
    Route::put('user/{id}', [UsersController::class, 'update'])->middleware('auth.users');
    Route::delete('user/{id}', [UsersController::class, 'destroy'])->middleware('auth.users');
});

// Ordenes
Route::controller(OrdersController::class)->group(function () {
    Route::post('order', [OrdersController::class, 'store'])->middleware('auth.orders');
    Route::get('order/{id}', [OrdersController::class, 'show'])->middleware('auth.orders');
    Route::put('order/{id}', [OrdersController::class, 'update'])->middleware('auth.orders');
    // Route::delete('order/{id}', [OrdersController::class, 'destroy'])->middleware('auth.orders');
});

// Detalles de la orden
Route::controller(OrderDetailsController::class)->group(function () {
    Route::post('order_detail', [OrderDetailsController::class, 'store'])->middleware('auth.order_details');
    Route::get('order_detail/{id}', [OrderDetailsController::class, 'show'])->middleware('auth.order_details');
    Route::put('order_detail/{id}', [OrderDetailsController::class, 'update'])->middleware('auth.order_details');
    // Route::delete('order_detail/{id}', [OrderDetailsController::class, 'destroy'])->middleware('auth.order_details');
});

// Métodos de pago
Route::controller(PaymentMethodsController::class)->group(function () {
    Route::get('payment_methods', [PaymentMethodsController::class, 'index'])->middleware('auth.paymentMethods');
    Route::post('payment_method', [PaymentMethodsController::class, 'store'])->middleware('auth.paymentMethods');
    Route::get('payment_method/{id}', [PaymentMethodsController::class, 'show'])->middleware('auth.paymentMethods');
    Route::put('payment_method/{id}', [PaymentMethodsController::class, 'update'])->middleware('auth.paymentMethods');
    Route::delete('payment_method/{id}', [PaymentMethodsController::class, 'destroy'])->middleware('auth.paymentMethods');
});

// Roles
Route::controller(RolesController::class)->group(function () {
    Route::get('roles', [RolesController::class, 'index'])->middleware('auth.entrepreneurships');
    Route::post('role', [RolesController::class, 'store'])->middleware('auth.entrepreneurships');
    Route::get('role/{id}', [RolesController::class, 'show'])->middleware('auth.entrepreneurships');
    Route::put('role/{id}', [RolesController::class, 'update'])->middleware('auth.entrepreneurships');
    Route::delete('role/{id}', [RolesController::class, 'destroy'])->middleware('auth.entrepreneurships');
});

// Asignación de roles
Route::controller(RoleAsignmentsController::class)->group(function () {
    Route::get('roleAssignments', [RoleAsignmentsController::class, 'index']);
    Route::post('roleAssignment', [RoleAsignmentsController::class, 'store'])->middleware('auth.roleAssignments');
    Route::get('roleAssignment/{id}', [RoleAsignmentsController::class, 'show']);
    Route::put('roleAssignment/{id}', [RoleAsignmentsController::class, 'update'])->middleware('auth.roleAssignments');
    Route::delete('roleAssignment/{id}', [RoleAsignmentsController::class, 'destroy'])->middleware('auth.roleAssignments');
});
