<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model {
    protected $fillable = ['nom', ];
    public function etablissement() {
        return $this->belongsTo(Etablissement::class);
    }
    public function eleves() {
        return $this->hasMany(Eleve::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

