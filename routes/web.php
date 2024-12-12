<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ShowLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;

Route::get('/login', ShowLoginController::class)->name('login');

Route::post('/login', LoginController::class);


