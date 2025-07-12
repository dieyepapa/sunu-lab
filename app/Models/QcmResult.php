<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QcmResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'eleve_id',
        'question_id',
        'reponse_eleve',
        'correcte',
        'temps_reponse',
        'date_reponse'
    ];

    protected $casts = [
        'correcte' => 'boolean',
        'date_reponse' => 'datetime'
    ];

    // Relation avec l'élève
    public function eleve()
    {
        return $this->belongsTo(User::class, 'eleve_id');
    }

    // Relation avec la question
    public function question()
    {
        return $this->belongsTo(QcmQuestion::class, 'question_id');
    }
}
