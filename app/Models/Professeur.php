<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professeur extends Model {
    protected $fillable = ['user_id'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function simulations() {
        return $this->hasMany(Simulation::class);
    }
}