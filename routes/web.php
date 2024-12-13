<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ShowLoginController;
use App\Http\Controllers\Dashboard\DashboardController;

use App\Toolbox\calcul_projet;

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



Route::get('/test-revenus/{userId}', function ($userId) {
    // Appeler la fonction pour calculer les revenus
    $revenus = calcul_projet::calculerRevenus($userId);

    // Retourner le résultat au format JSON
    return response()->json($revenus);
});


Route::get('/test-revenus-previ/{userId}', function ($userId) {
    // Appeler la fonction pour calculer les revenus
    $revenus = calcul_projet::calculerRevenusPrevi($userId);

    // Retourner le résultat au format JSON
    return response()->json($revenus);
});
