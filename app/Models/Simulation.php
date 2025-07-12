<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simulation extends Model {
    protected $fillable = [
        'titre', 'description', 'chapitre', 'date',
        'type_simulation', 'contexte', 'lien_meet',
        'notification_envoyee', 'professeur_id', 'classe_id'
    ];
    public function professeur() {
        return $this->belongsTo(Professeur::class);
    }
    public function classe() {
        return $this->belongsTo(Classe::class);
    }
}