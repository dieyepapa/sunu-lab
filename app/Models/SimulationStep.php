<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulationStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'experiment_id',
        'ordre',
        'titre',
        'description',
        'instructions',
        'actions_possibles',
        'resultats_attendus',
        'donnees_simulation',
        'obligatoire'
    ];

    protected $casts = [
        'actions_possibles' => 'array',
        'resultats_attendus' => 'array',
        'donnees_simulation' => 'array',
        'obligatoire' => 'boolean'
    ];

    // Relation avec l'expérience
    public function experiment()
    {
        return $this->belongsTo(SimulationExperiment::class, 'experiment_id');
    }
}
