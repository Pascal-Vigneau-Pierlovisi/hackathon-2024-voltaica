<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Caff;
use Illuminate\Http\Request;


class AnnuaireController extends Controller
{
    public function __invoke(Request $request){

        // Récupérer les managers pour le filtre
        $managers = Caff::whereNotNull('manager_id')->distinct()->get();

        // Appliquer les filtres
        $caffs = Caff::query()
            ->when($request->name, function ($query, $name) {
                $query->where('nom', 'like', "%$name%");
            })
            ->when($request->manager, function ($query, $managerId) {
                $query->where('manager_id', $managerId);
            })
            ->with('manager') // Charger la relation manager
            ->get();

        return view('dashboard.collaborateurs', compact('caffs', 'managers'));


    }
}
