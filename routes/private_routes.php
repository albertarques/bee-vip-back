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
    Route::patch('me/update', 'update_me')->middleware('can:user-update-my-profile');
    Route::delete('me/delete', 'destroy_me')->middleware('can:user-delete-my-profile');

    // Superadmin ***********************************************************
    Route::delete('user/delete/{id}', 'destroy')->middleware('can:user-delete');

    // TODO: Is this route necessary?
    Route::patch('user/update/{id}', 'update_role')->middleware('can:user-role-update');
  });
  // Rutas con Autorización y Permisos
  Route::controller(PaymentMethodsController::class)->group(function () {

    // TODO: Add Payment Methods list
    // TODO: Add user authentication on all payment methods
    Route::post('paymentmethod/create', 'create')->middleware('can:payment-method-create');
    Route::delete('paymentmethod/delete/{id}', 'destroy')->middleware('can:payment-method-delete');
    Route::get('paymentmethod/show/{id}', 'show')->middleware('can:payment-method-show');
    Route::patch('paymentmethod/update/{id}', 'update')->middleware('can:payment-method-update');
  });
  Route::controller(OrdersController::class)->group(function () {
    // User, Admin, Superadmin **********************************************
    Route::post('order/create', 'create')->middleware('can:order-create');
    Route::get('order/show/{id}', 'show')->middleware('can:order-show');
    Route::patch('order/update/{id}', 'update')->middleware('can:order-update');

    // TODO: Is this route necessary?
    Route::delete('order/delete/{id}', 'delete')->middleware('can:order-delete');
  });
  Route::controller(OrderDetailsController::class)->group(function () {
    // User, Admin, Superadmin **********************************************
    Route::post('orderdetail/create', 'create')->middleware('can:order-detail-create');
  });
  Route::controller(EntrepreneurshipsController::class)->group(function () {

    // Admin user *************************************************************************************
      Route::post('entrepreneurship/create', 'create')->middleware('can:entrepreneurship-create');
      Route::delete('delete/my/entrepreneurship', 'destroy_my')->middleware('can:entrepreneurship-delete-my');
      Route::patch('update/my/entrepreneurship', 'update_my')->middleware('can:entrepreneurship-update-my');
      Route::get('view/my/entrepreneurships', 'index_my')->middleware('can:entrepreneurships-view-my');

    // Superadmin user ********************************************************************************
      Route::delete('delete/entrepreneurship/{id}', 'destroy')->middleware('can:entrepreneurship-delete');
      Route::patch('inspect/entrepreneurship/{id}', 'inspect')->middleware('can:entrepreneurship-inspect');
      Route::get('entrepreneurships/pending', 'pending')->middleware('can:entrepreneurships-view-pending');
  });
  Route::controller(CommentsController::class)->group(function () {
    // User, Admin, Superadmin **********************************************
      Route::post('create/comment/{entrepreneurship_id}', 'create')->middleware('can:comment-create');
      Route::patch('update/my_comment/{id}', 'update')->middleware('can:comment-update-my');
      Route::delete('delete/my_comment/{id}', 'delete_mine')->middleware('can:comment-delete-my');

    // Superadmin ***********************************************************
      Route::delete('delete/comment/{id}', 'delete')->middleware('can:comment-delete');
  });
  Route::controller(CategoriesController::class)->group(function () {
    // Superadmin **********************************************
      Route::post('category', 'create')->middleware('can:category-create');
      Route::patch('update/category/{id}', 'update')->middleware('can:category-update');
      Route::delete('delete/category/{id}', 'destroy')->middleware('can:category-delete');
  });

});
