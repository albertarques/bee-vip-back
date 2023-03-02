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

// Rutas con autenticación.
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('register', 'App\Http\Controllers\AuthController@register');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');

    // TODO: Añadir lista emprendimientos, rol del usuario.
    Route::post('me', 'App\Http\Controllers\AuthController@me');

    // Podemos ver todas las órdenes del sistema sin estar logeado! MAL!
    // Route::controller(OrdersController::class)->group(function () {
    //     Route::get('orders', 'index'); // Devolver solo las ordenens del usuario
    // });
});

// Rutas para usuarios registrados
Route::group(['middleware' => 'auth.jwt'], function () {

    Route::controller(EntrepreneurshipsController::class)->group(function () {
        Route::post('/entrepreneurship/create', 'store')->middleware('can:create-bussines');
        Route::post('/orders', 'store');
    });

    // // Rutas para usuarios con rol User
    // Route::group(['middleware:auth' => 'role:user'], function (){

    // });

    // // Rutas para usuarios con role Admin
    // Route::group(['middleware:auth' => 'role:admin'], function (){
    // });

    // // Rutas para usuarios con role Superadmin
    // Route::group(['middleware:auth' => 'role:superadmin'], function (){
    //     // Devuelve todas las rutas del sistema.
    //     // Route::get('orders', [OrdersController::class, 'index']);

    // });


});


// Usuarios

// Route::controller(UsersController::class)->group(function () {
    // Route::get('users', [UsersController::class, 'index']);
    // Devuelve un usuario y sus emprendimientos.
    // Route::get('user', 'show');
// });

// Categorías
// Route::controller(CategoriesController::class)->group(function () {
//     Route::get('categories', 'index');
//     Route::post('category', 'store');
//     Route::get('category/{id}', 'show');
//     Route::put('category/{id}', 'update');
//     // Route::delete('category/{id}', 'destroy')->middleware('auth.entrepreneurships');
// });

// Emprendimientos
// Route::controller(EntrepreneurshipsController::class)->group(function () {
//     Route::get('entrepreneurships', 'approvedIndex');
//     Route::get('entrepreneurships_pending', 'pendingIndex');
//     Route::post('entrepreneurship', 'store')->middleware('auth.')
//     Route::get('entrepreneurship/{id}', 'show');
//     Route::put('entrepreneurship/{id}', 'update');
//     Route::delete('entrepreneurship/{id}', 'destroy');
// });

// Comentarios
// Route::controller(CommentsController::class)->group(function () {
//     Route::post('comment', 'store');
//     Route::get('comment/{id}', 'show');
//     Route::put('comment/{id}', 'update');
//     Route::delete('comment/{id}', 'destroy');
// });

// Usuarios
// Route::controller(UsersController::class)->group(function () {
//     Route::post('user', 'store');
//     Route::get('user/{id}', 'show');
//     Route::put('user/{id}', 'update');
//     Route::delete('user/{id}', 'destroy');
// });

// Ordenes
// Route::controller(OrdersController::class)->group(function () {
//     Route::post('order', 'store');
//     Route::get('order/{id}', 'show');
    // Route::put('order/{id}', 'update')->middleware('auth.orders');
    // Route::delete('order/{id}', 'destroy'])->middleware('auth.orders');
// });

// Detalles de la orden
// Route::controller(OrderDetailsController::class)->group(function () {
//     Route::post('order_detail', 'store');
//     Route::get('order_detail/{id}', 'show');
//     Route::put('order_detail/{id}', 'update');
//     // Route::delete('order_detail/{id}', 'destroy'])->middleware('auth.order_details');
// });

// Métodos de pago
// Route::controller(PaymentMethodsController::class)->group(function () {
//     // TODO: Devolver los métodos del pago del usuario.
//     Route::get('payment_methods','index');
//     // TODO: Añadir método de pago.
//     Route::post('payment_method','store');
//     // TODO: Ver método de pago.
//     Route::get('payment_method/{id}','show');
//     // TODO: Actualizar método de pago
//     Route::put('payment_method/{id}','update');
//     // TODO: Eliminar.
//     Route::delete('payment_method/{id}','destroy');
// });

// Roles
// Route::controller(RolesController::class)->group(function () {
//     Route::get('roles', 'index');
//     Route::post('role', 'store');
//     Route::get('role/{id}', 'show');
//     Route::put('role/{id}', 'update');
//     Route::delete('role/{id}', 'destroy');
// });

// Asignación de roles
// Route::controller(RoleAsignmentsController::class)->group(function () {
//     Route::get('roleAssignments', 'index');
//     Route::post('roleAssignment', 'store');
//     Route::get('roleAssignment/{id}', 'show');
//     Route::put('roleAssignment/{id}', 'update');
//     Route::delete('roleAssignment/{id}', 'destroy');
// });
