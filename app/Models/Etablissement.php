<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model {
    protected $fillable = ['nom', 'adresse'];
    public function classes() {
        return $this->hasMany(Classe::class);
    }
}
