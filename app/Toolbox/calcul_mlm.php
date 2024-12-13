<?php

use App\Models\Dossier;
use App\Models\Caff;

// 1. Retourner l'ensemble des dossiers en fonction de critères spécifiques
function getDossiersByCaffIdForMlm($caffId)
{
    return Dossier::where('id_caff', $caffId)
        ->where('status', 'Etabli')
        ->where('date_completude', '<=', now()->subMonths(3))
        ->where('date_completude', '>', now()->subYear()->subMonths(3))
        ->get();
}

// 2. Retourner l'ensemble des Caffs managés par un Caff choisi (récursif)
function getManagedCaffs($caffId)
{
    $managedCaffs = collect();

    // Fonction récursive interne
    $fetchManagedCaffs = function($managerId) use (&$fetchManagedCaffs, &$managedCaffs) {
        $directReports = Caff::where('manager_id', $managerId)->get();
        foreach ($directReports as $caff) {
            $managedCaffs->push($caff);
            $fetchManagedCaffs($caff->id); // Appel récursif
        }
    };

    $fetchManagedCaffs($caffId);
    return $managedCaffs;
}

// 3. Calcul des revenus MLM filtrés par mois
function calculateMonthlyMLMRevenues($caffId)
{
    if (!eligibiliteMLM($caffId)) {
        return 0;
    }
    $managedCaffs = getManagedCaffs($caffId);
    $commissionRates = [1 => 0.07, 2 => 0.03, 3 => 0.01, 4 => 0.005];
    $monthlyRevenues = array_fill(1, 12, 0);

    foreach ($managedCaffs as $managedCaff) {
        $levelDifference = $managedCaff->niveau - Caff::find($caffId)->niveau;
        if (isset($commissionRates[$levelDifference])) {
            $projects = getDossiersByCaffIdForMlm($managedCaff->id);
            
            foreach ($projects as $project) {
                $completionMonth = $project->date_completude->addMonths(3)->month;
                $currentYear = $project->date_completude->addMonths(3)->year;

                if ($currentYear === now()->year || $currentYear === now()->addYear()->year) {
                    $projectRevenue = $project->apporteur_affaire 
                        ? 25 * $project->puissance_estimee 
                        : 20 * $project->puissance_estimee;
                    $monthlyRevenues[$completionMonth] += $projectRevenue * $commissionRates[$levelDifference];
                }
            }
        }
    }
    return $monthlyRevenues;
}

// 4. Calcul de la somme totale des revenus MLM
function calculateTotalMLMRevenues($caffId)
{
    $monthlyRevenues = calculateMonthlyMLMRevenues($caffId);
    return array_sum($monthlyRevenues);
}

// 5. Récupération des mois et années courants et suivants
function getNextTwelveMonths()
{
    $months = [];
    for ($i = 0; $i < 12; $i++) {
        $date = now()->addMonths($i);
        $months[] = $date->format('m-Y');
    }
    return $months;
}

// 6. Vérification de l'éligibilité MLM
function eligibiliteMLM($caffId)
{
    $currentYearProjects = Dossier::where('id_caff', $caffId)
        ->whereYear('date_signature_pdb', now()->year)
        ->get();

    $totalPower = $currentYearProjects->sum('puissance_estimee');
    $quota = Caff::find($caffId)->grade->quota;

    return $totalPower >= $quota;
}


// 3. Calcul des revenus MLM par niveau de grade
function calculateMLMRevenuesByLevel($caffId)
{
    if (!eligibiliteMLM($caffId)) {
        return 0;
    }
    $managedCaffs = getManagedCaffs($caffId);
    $commissionRates = [1 => 0.07, 2 => 0.03, 3 => 0.01, 4 => 0.005];
    $revenuesByLevel = [];

    foreach ($managedCaffs as $managedCaff) {
        $levelDifference = $managedCaff->niveau - Caff::find($caffId)->niveau;
        if (isset($commissionRates[$levelDifference])) {
            $projects = getDossiersByCaffIdForMlm($managedCaff->id);

            foreach ($projects as $project) {
                $projectRevenue = $project->apporteur_affaire 
                    ? 25 * $project->puissance_estimee 
                    : 20 * $project->puissance_estimee;
                
                if (!isset($revenuesByLevel[$levelDifference])) {
                    $revenuesByLevel[$levelDifference] = 0;
                }

                $revenuesByLevel[$levelDifference] += $projectRevenue * $commissionRates[$levelDifference];
            }
        }
    }

    return $revenuesByLevel;
}