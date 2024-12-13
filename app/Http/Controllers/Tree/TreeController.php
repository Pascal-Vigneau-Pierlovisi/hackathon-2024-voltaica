<?php

namespace App\Http\Controllers\Tree;

use App\Http\Controllers\Controller;
use App\Models\Caff;
use Illuminate\Support\Facades\Auth;

class TreeController extends Controller
{
public function __invoke()
{
// Charger le collaborateur connecté avec ses subordonnés
$tree = Caff::where('id', Auth::id())
->with('subordinates.subordinates') // Charger récursivement les subordonnés
->first();

return view('arbre.tree', compact('tree'));
}
}
