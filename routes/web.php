<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ShowLoginController;

Route::get('/login', ShowLoginController::class)->name('login');

