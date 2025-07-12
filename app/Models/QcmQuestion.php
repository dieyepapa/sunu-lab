<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QcmQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'question',
        'options',
        'bonne_reponse',
        'matiere',
        'niveau',
        'explication',
        'professeur_id',
        'actif'
    ];

    protected $casts = [
        'options' => 'array',
        'actif' => 'boolean'
    ];

    // Relation avec le professeur
    public function professeur()
    {
        return $this->belongsTo(User::class, 'professeur_id');
    }

    // Relation avec les résultats
    public function resultats()
    {
        return $this->hasMany(QcmResult::class, 'question_id');
    }

    // Scopes pour filtrer
    public function scopeActif($query)
    {
        return $query->where('actif', true);
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
