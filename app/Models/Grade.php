<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'libelle',
    ];

    public $timestamps = false;

    public function caffs()
    {
        return $this->hasMany(Caff::class);
    }
}
