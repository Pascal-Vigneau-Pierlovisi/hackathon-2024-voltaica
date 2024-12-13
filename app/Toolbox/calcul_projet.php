<?php

namespace App\Toolbox;

use App\Models\Dossier;
use Carbon\Carbon;

class calcul_projet
{
    /**
     * Calculer les revenus des projets pour un utilisateur donné sur les 12 derniers mois.
     *
     * @param int $userId
     * @return array
     */
    public static function calculerRevenus($userId)
    {
        // Récupérer les dossiers "Etabli" associés à l'utilisateur
        $dossiers = Dossier::where('id_caff', $userId)
            ->where('status', 'Etabli')
            ->whereBetween('date_completude', [now(), now()->addMonths(12)])
            ->get();

        $resultat = [];

        foreach ($dossiers as $dossier) {
            // Calcul du bénéfice en fonction du type d'utilisateur (porteur d'affaire ou non)
            $benefice = $dossier->apporteur_affaire
                ? 25 * $dossier->puissance_estimee
                : 20 * $dossier->puissance_estimee;

            // Date de paiement (3 mois après la date de complétude)
            $datePaiement = Carbon::parse($dossier->date_completude)->addMonths(3);

            // Ajouter les informations dans le tableau de résultats
            $resultat[] = [
                'id_caff' => $dossier->id_caff,
                'id_dossier' => $dossier->id,
                'benefice' => $benefice,
                'date_paiement' => $datePaiement->format('Y-m-d'),
            ];
        }

        return $resultat;
    }



    public static function calculerRevenusPrevi($userId)
    {
        // Récupérer les dossiers "Etabli" associés à l'utilisateur
        $dossiers = Dossier::where('id_caff', $userId)
            ->where('status', 'En cours')
            ->get();

        $resultat = [];

        foreach ($dossiers as $dossier) {
            // Calcul du bénéfice en fonction du type d'utilisateur (porteur d'affaire ou non)
            $benefice = $dossier->apporteur_affaire
                ? 25 * $dossier->puissance_estimee
                : 20 * $dossier->puissance_estimee;

            // Date de paiement (3 mois après la date de complétude)
            $datePaiement = Carbon::parse($dossier->date_completude);

            // Ajouter les informations dans le tableau de résultats
            $resultat[] = [
                'id_caff' => $dossier->id_caff,
                'id_dossier' => $dossier->id,
                'benefice' => $benefice,
            ];
        }

        return $resultat;
    }
}
