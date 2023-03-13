<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\PaymentMethodsController;
use App\Http\Controllers\EntrepreneurshipsController;

// Rutas públicas
require __DIR__.'/public_routes.php';

// Rutas con autenticación JWT
require __DIR__.'/jwt_routes.php';

// Rutas con autenticación y permisos de Spatie
require __DIR__.'/private_routes.php';
