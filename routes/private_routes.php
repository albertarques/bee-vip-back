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
// Rutas con Autorización *************************************************
  Route::post('logout', 'App\Http\Controllers\AuthController@logout');
  Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
  Route::post('me', 'App\Http\Controllers\AuthController@me');

  Route::controller(UsersController::class)->group(function () {
    // User, Admin, Superadmin **********************************************
    Route::patch('me/update', 'update_me')->middleware('can:user-update-my-profile');
    Route::delete('me/delete', 'destroy_me')->middleware('can:user-delete-my-profile');
    Route::patch('user/update/{id}', 'update')->middleware('can:user-update');

    // Superadmin ***********************************************************
    Route::delete('user/delete/{id}', 'destroy')->middleware('can:user-delete');
    Route::patch('user/update/{id}', 'update_role')->middleware('can:user-role-update');
  });

  // TODO: WHAT'S HAPPENS WITH THIS ROUTE?
  Route::post('payments', [PaymentController::class, 'process']);

// Rutas con Autorización y Permisos
  Route::controller(PaymentMethodsController::class)->group(function () {
    Route::post('paymentmethod/create', 'create')->middleware('can:payment-method-create');
    Route::get('paymentmethods', 'index')->middleware('can:payment-method-view');
    Route::delete('paymentmethod/delete/{id}', 'destroy')->middleware('can:payment-method-delete');
    Route::get('paymentmethod/show/{id}', 'show')->middleware('can:payment-method-show');
    Route::patch('paymentmethod/update/{id}', 'update')->middleware('can:payment-method-update');
  });
  Route::controller(OrdersController::class)->group(function () {
    // User, Admin, Superadmin ************************************************************************
    Route::post('order/create', 'create')->middleware('can:order-create');
    Route::get('orders_my', 'index')->middleware('can:orders-view-my');
    Route::get('order/{id}', 'show')->middleware('can:order-show');
    // Route::patch('order/update/{id}', 'update')->middleware('can:order-update'); //

    // TODO: Is this route necessary?
    // Route::delete('order/delete/{id}', 'delete')->middleware('can:order-delete'); //
  });
  Route::controller(OrderDetailsController::class)->group(function () {
    // User, Admin, Superadmin *************************************************************************
    Route::post('orderdetail/create', 'create')->middleware('can:order-detail-create');
  });
  Route::controller(EntrepreneurshipsController::class)->group(function () {
    // Admin user *************************************************************************************
      Route::post('entrepreneurship/create', 'create')->middleware('can:entrepreneurship-create');
      Route::delete('entrepreneurship/delete_my/{id}', 'destroy_my')->middleware('can:entrepreneurship-delete-my');
      Route::patch('entrepreneurship/update_my/{id}', 'update_my')->middleware('can:entrepreneurship-update');
      Route::get('entrepreneurships/view_my', 'index_my')->middleware('can:entrepreneurships-view-my');

    // Superadmin user ********************************************************************************
      Route::delete('entrepreneurship/delete/{id}', 'destroy')->middleware('can:entrepreneurship-delete');
      Route::patch('entrepreneurship/inspect/{id}', 'inspect')->middleware('can:entrepreneurship-inspect');
      Route::get('entrepreneurships/pending', 'index_pending')->middleware('can:entrepreneurships-view-pending');
  });
  Route::controller(CommentsController::class)->group(function () {
    // User, Admin, Superadmin *************************************************************************
      // TODO: Add condition that user need to be bought the service would comment.
      Route::post('comment/create/{entrepreneurship_id}', 'create')->middleware('can:comment-create');
      Route::get('comments', 'index_my')->middleware('can:comments-view');
      Route::patch('comment/update_my/{id}', 'update_my')->middleware('can:comment-update-my');
      Route::delete('comment/delete_my/{id}', 'delete_my')->middleware('can:comment-delete-my');

    // Superadmin **************************************************************************************
      Route::delete('comment/delete/{id}', 'delete')->middleware('can:comment-delete');
  });
  Route::controller(CategoriesController::class)->group(function () {
    // Superadmin **************************************************************************************
      Route::post('category/create', 'create')->middleware('can:category-create');
      Route::patch('category/update/{id}', 'update')->middleware('can:category-update');
      Route::delete('category/delete/{id}', 'destroy')->middleware('can:category-delete');
  });
});
