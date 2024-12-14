<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke(){

        $graphData = [
            'series' => [
                [
                    'name' => 'Revenus Estimés',
                    'data' => [3000, 6250, 3000, 5200, 2000, 7500, 2000, 12000, 2000, 4000, 6000]
                ],
                [
                    'name' => 'Revenus Réels',
                    'data' => [3500, 6800, 0, 5600, 2500, 8000, 0, 13000, 0, 0, 0]
                ],
                [
                    'name' => 'Revenus Totaux',
                    'data' => [5160, 8460, 1660, 7260, 4160, 8000, 0, 13000, 0, 0, 0]
                ]
            ],
            'categories' => ['Décembre 2023', 'Janvier 2024', 'Février 2024', 'Mars 2024', 'Avril 2024', 'Mai 2024', 'Juin 2024', 'Juillet 2024', 'Août 2024', 'Septembre 2024', 'Octobre 2024', 'Novembre 2024', 'Décembre 2024']
        ];


        // Retourner la vue avec les données
        return view('dashboard.dashboard', compact('graphData'));
    }
}
