<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Facades\Hash;

class Caff extends Authenticatable implements AuthenticatableContract
{
    use Notifiable;

    // Spécifie le nom de la table associée au modèle
    protected $table = 'caff';

    protected $fillable = [
        'nom',
        'prenom',
        'ville',
        'code_postal',
        'email',
        'telephone',
        'username',
        'password',
        'manager_id',
        'grade_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $timestamps = false;

    // Relation pour le manager
    public function manager()
    {
        return $this->belongsTo(Caff::class, 'manager_id');
    }

    // Relation pour les subordonnés
    public function subordinates()
    {
        return $this->hasMany(Caff::class, 'manager_id');
    }

    // Relation pour le grade
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    // Mutateur pour hacher le mot de passe
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
