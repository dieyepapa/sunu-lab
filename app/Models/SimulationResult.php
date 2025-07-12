<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulationResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'eleve_id',
        'experiment_id',
        'resultats_etapes',
        'donnees_collectees',
        'temps_total',
        'etapes_completees',
        'score',
        'observations_eleve',
        'commentaires_professeur',
        'date_debut',
        'date_fin'
    ];

    protected $casts = [
        'resultats_etapes' => 'array',
        'donnees_collectees' => 'array',
        'date_debut' => 'datetime',
        'date_fin' => 'datetime'
    ];

    // Relation avec l'élève
    public function eleve()
    {
        return $this->belongsTo(User::class, 'eleve_id');
    }

    // Relation avec l'expérience
    public function experiment()
    {
        return $this->belongsTo(SimulationExperiment::class, 'experiment_id');
    }
}
