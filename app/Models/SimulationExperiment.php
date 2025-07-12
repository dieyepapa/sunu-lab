<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulationExperiment extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'matiere',
        'niveau',
        'objectifs',
        'materiel_virtuel',
        'duree_estimee',
        'instructions_generales',
        'professeur_id',
        'actif',
        'public'
    ];

    protected $casts = [
        'objectifs' => 'array',
        'materiel_virtuel' => 'array',
        'actif' => 'boolean',
        'public' => 'boolean'
    ];

    // Relation avec le professeur
    public function professeur()
    {
        return $this->belongsTo(User::class, 'professeur_id');
    }

    // Relation avec les étapes
    public function etapes()
    {
        return $this->hasMany(SimulationStep::class, 'experiment_id')->orderBy('ordre');
    }

    // Relation avec les résultats
    public function resultats()
    {
        return $this->hasMany(SimulationResult::class, 'experiment_id');
    }

    // Scopes pour filtrer
    public function scopeActif($query)
    {
        return $query->where('actif', true);
    }

    public function scopePublic($query)
    {
        return $query->where('public', true);
    }

    public function scopeParMatiere($query, $matiere)
    {
        return $query->where('matiere', $matiere);
    }

    public function scopeParNiveau($query, $niveau)
    {
        return $query->where('niveau', $niveau);
    }
}
