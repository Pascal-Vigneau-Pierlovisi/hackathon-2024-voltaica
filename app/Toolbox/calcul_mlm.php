<?php

namespace App\Toolbox;

use App\Models\Dossier;
use App\Models\Caff;

class calcul_mlm
{
    /**
     * Retourner l'ensemble des dossiers en fonction de critères spécifiques
     */
    public static function getDossiersByCaffIdForMlm($caffId)
    {
        $dossiers = Dossier::where('id_caff', $caffId)
            ->where('status', 'Etabli')
            ->get();
        return $dossiers;
    }

    /**
     * Retourner l'ensemble des Caffs managés par un Caff choisi (récursif)
     */
    public static function getManagedCaffs($caffId)
    {
        $managedCaffs = collect();

        // Fonction récursive interne
        $fetchManagedCaffs = function ($managerId) use (&$fetchManagedCaffs, &$managedCaffs) {
            $directReports = Caff::where('manager_id', $managerId)->get();
            foreach ($directReports as $caff) {
                $managedCaffs->push($caff);
                $fetchManagedCaffs($caff->id); // Appel récursif
            }
        };

        $fetchManagedCaffs($caffId);
        return $managedCaffs;
    }

    /**
     * Calcul des revenus MLM filtrés par mois
     */
    public static function calculateMonthlyMLMRevenues($caffId)
    {
        if (!self::eligibiliteMLM($caffId)) {
            dd("L'utilisateur n'est pas éligible.");
        }

        $managedCaffs = self::getManagedCaffs($caffId);

        $commissionRates = [1 => 0.07, 2 => 0.03, 3 => 0.01, 4 => 0.005];
        $monthlyRevenues = array_fill(1, 12, 0);

        foreach ($managedCaffs as $managedCaff) {
            $levelDifference = $managedCaff->niveau - Caff::find($caffId)->niveau;
            if (isset($commissionRates[$levelDifference])) {
                $projects = self::getDossiersByCaffIdForMlm($managedCaff->id);


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

    /**
     * Calcul de la somme totale des revenus MLM
     */
    public static function calculateTotalMLMRevenues($caffId)
    {
        $monthlyRevenues = self::calculateMonthlyMLMRevenues($caffId);
        return array_sum($monthlyRevenues);
    }

    /**
     * Récupération des mois et années courants et suivants
     */
    public static function getNextTwelveMonths()
    {
        $months = [];
        for ($i = 0; $i < 12; $i++) {
            $date = now()->addMonths($i);
            $months[] = $date->format('m-Y');
        }
        return $months;
    }

    /**
     * Vérification de l'éligibilité MLM
     */
    public static function eligibiliteMLM($caffId)
    {
        $currentYearProjects = Dossier::where('id_caff', $caffId)
            ->whereYear('date_signature', now()->year)
            ->get();

        $totalPower = $currentYearProjects->sum('puissance_estimee');
        $quota = Caff::find($caffId)->grade->quota;

        return $totalPower >= $quota;
    }

    /**
     * Calcul des revenus MLM par niveau de grade
     */
    public static function calculateMLMRevenuesByLevel($caffId)
    {
        if (!self::eligibiliteMLM($caffId)) {
            return 0;
        }
        $managedCaffs = self::getManagedCaffs($caffId);
        $commissionRates = [1 => 0.07, 2 => 0.03, 3 => 0.01, 4 => 0.005];
        $revenuesByLevel = [];

        foreach ($managedCaffs as $managedCaff) {
            $levelDifference = $managedCaff->niveau - Caff::find($caffId)->niveau;
            if (isset($commissionRates[$levelDifference])) {
                $projects = self::getDossiersByCaffIdForMlm($managedCaff->id);

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
}
