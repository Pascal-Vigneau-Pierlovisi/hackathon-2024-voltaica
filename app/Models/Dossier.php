<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    protected $table = 'dossier';
    protected $fillable = [
        'id_client',
        'id_caff',
        'apporteur_affaire',
        'puissance_estimee',
        'status',
        'date_signature_pdb',
        'date_completude'
    ];

    // Désactiver les timestamps
    public $timestamps = false;

    // Définir les relations
    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public function caff()
    {
        return $this->belongsTo(Caff::class, 'id_caff');
    }
}
