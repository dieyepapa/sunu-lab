<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simulation extends Model {
    protected $fillable = [
        'titre', 'description', 'type', 'difficulte',
        'instructions', 'statut', 'professeur_id'
    ];
    public function professeur() {
        return $this->belongsTo(Professeur::class);
    }
}