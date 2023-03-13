<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\PaymentMethodsController;
use App\Http\Controllers\EntrepreneurshipsController;

Route::middleware(['middleware' => 'auth.jwt'])->group(function () {

  Route::post('payments', [PaymentController::class, 'process']);

  Route::controller(UsersController::class)->group(function () {
    // User, Admin, Superadmin **********************************************
    Route::patch('me/update', 'update_me')->middleware('can:update-my-profile');
    Route::delete('me/delete', 'destroy_me')->middleware('can:delete-my-profile');

    // Superadmin ***********************************************************
    Route::delete('user/delete/{id}', 'destroy')->middleware('can:delete-user');

    // TODO: Is this route necessary?
    Route::patch('user/update/{id}', 'update_role')->middleware('can:update-user-role');
  });
  // Rutas con Autorización y Permisos
  Route::controller(PaymentMethodsController::class)->group(function () {

    // TODO: Add Payment Methods list
    // TODO: Add user authentication on all payment methods
    Route::post('paymentmethod/create', 'create')->middleware('can:create-payment-method');
    Route::delete('paymentmethod/delete/{id}', 'destroy')->middleware('can:delete-payment-method');
    Route::get('paymentmethod/show/{id}', 'show')->middleware('can:show-payment-method');
    Route::patch('paymentmethod/update/{id}', 'update')->middleware('can:update-payment-method');
  });
  Route::controller(OrdersController::class)->group(function () {
    // User, Admin, Superadmin **********************************************
    Route::post('order/create', 'create')->middleware('can:create-order');
    Route::get('order/show/{id}', 'show')->middleware('can:show-order');
    Route::patch('order/update/{id}', 'update')->middleware('can:update-order');

    // TODO: Is this route necessary?
    Route::delete('order/delete/{id}', 'delete')->middleware('can:delete-order');
  });
  Route::controller(OrderDetailsController::class)->group(function () {
    // User, Admin, Superadmin **********************************************
    Route::post('orderdetail/create', 'create')->middleware('can:create-order-detail');
  });
  Route::controller(EntrepreneurshipsController::class)->group(function () {

    // Admin user *************************************************************************************
    Route::post('entrepreneurship/create', 'create')->middleware('can:create-entrepreneurship');
    Route::delete('delete/my/entrepreneurship', 'destroy_my')->middleware('can:delete-my-entrepreneurship');
    Route::patch('update/my/entrepreneurship', 'update_my')->middleware('can:update-my-entrepreneurship');
    Route::get('view/my/entrepreneurships', 'index_my')->middleware('can:view-my-entrepreneurships');

    // Superadmin user ********************************************************************************
    Route::delete('delete/entrepreneurship/{id}', 'destroy')->middleware('can:delete-entrepreneurship');
    Route::patch('inspect/entrepreneurship/{id}', 'inspect')->middleware('can:inspect-entrepreneurship');
    Route::get('entrepreneurships/pending', 'pending')->middleware('can:view-pending-entrepreneurships');
  });
  Route::controller(CommentsController::class)->group(function () {
    // User, Admin, Superadmin **********************************************
    Route::post('create/comment/{entrepreneurship_id}', 'create')->middleware('can:create-comment');
    Route::patch('update/my_comment/{id}', 'update')->middleware('can:update-my-comment');
    Route::delete('delete/my_comment/{id}', 'delete_mine')->middleware('can:delete-my-comment');

    // Superadmin ***********************************************************
    Route::delete('delete/comment/{id}', 'delete')->middleware('can:delete-comment');
  });
  Route::controller(CategoriesController::class)->group(function () {
    // Superadmin **********************************************
    Route::post('category', 'create')->middleware('can:create-category');
    Route::patch('update/category/{id}', 'update')->middleware('can:update-category');
    Route::delete('delete/category/{id}', 'destroy')->middleware('can:delete-category');
  });

});
