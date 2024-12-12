<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    // Colonnes autorisées à être insérées
    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'adresse',
        'siret',
        'email',
        'telephone',
        'nom_entreprise',
    ];
}
