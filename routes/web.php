<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ShowLoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\AnnuaireController;
use App\Http\Controllers\Tree\TreeController;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/hash-password', function (Illuminate\Http\Request $request) {
    $password = $request->input('password');
    if (!$password) {
        return response()->json(['error' => 'Please provide a password'], 400);
    }

    $hashedPassword = Hash::make($password);

    return response()->json(['hashed_password' => $hashedPassword]);
});

Route::get('/login', ShowLoginController::class)->name('login');

Route::post('/login', LoginController::class);

Route::post('/logout', LogoutController::class);

Route::get('/dashboard', DashboardController::class);
