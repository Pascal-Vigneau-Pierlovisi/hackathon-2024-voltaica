<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ShowLoginController;
use App\Http\Controllers\Dashboard\DashboardController;

use App\Toolbox\calcul_projet;
use App\Toolbox\calcul_mlm;


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



/*Route::get('/test-revenus/{userId}', function ($userId) {
    // Appeler la fonction pour calculer les revenus
    $revenus = calcul_projet::calculerRevenus($userId);

    // Retourner le résultat au format JSON
    return response()->json($revenus);
});*/

/*
Route::get('/test-revenus-previ/{userId}', function ($userId) {
    // Appeler la fonction pour calculer les revenus
    $revenus = calcul_projet::calculerRevenusPrevi($userId);

    // Retourner le résultat au format JSON
    return response()->json($revenus);
});*/


// 1. Retourner l'ensemble des dossiers en fonction de critères spécifiques
Route::get('/test-dossiers/{caffId}', function ($caffId) {
    $dossiers = calcul_mlm::getDossiersByCaffIdForMlm($caffId);
    return response()->json($dossiers);
});

// 2. Retourner l'ensemble des Caffs managés par un Caff choisi (récursif)
Route::get('/test-managed-caffs/{caffId}', function ($caffId) {
    $managedCaffs = calcul_mlm::getManagedCaffs($caffId);
    return response()->json($managedCaffs);
});

// 3. Calcul des revenus MLM filtrés par mois
Route::get('/test-monthly-revenues/{caffId}', function ($caffId) {
    $monthlyRevenues = calcul_mlm::calculateMonthlyMLMRevenues($caffId);
    return response()->json($monthlyRevenues);
});

// 4. Calcul de la somme totale des revenus MLM
Route::get('/test-total-revenues/{caffId}', function ($caffId) {
    $totalRevenues = calcul_mlm::calculateTotalMLMRevenues($caffId);
    return response()->json(['total_revenues' => $totalRevenues]);
});

// 5. Récupération des mois et années courants et suivants
Route::get('/test-next-twelve-months', function () {
    $months = calcul_mlm::getNextTwelveMonths();
    return response()->json($months);
});

// 6. Vérification de l'éligibilité MLM
Route::get('/test-eligibility/{caffId}', function ($caffId) {
    $isEligible = calcul_mlm::eligibiliteMLM($caffId);
    return response()->json(['is_eligible' => $isEligible]);
});

// 7. Calcul des revenus MLM par niveau de grade
Route::get('/test-revenues-by-level/{caffId}', function ($caffId) {
    $revenuesByLevel = calcul_mlm::calculateMLMRevenuesByLevel($caffId);
    return response()->json($revenuesByLevel);
});
