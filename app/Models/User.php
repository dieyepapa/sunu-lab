<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'idUser'; // 👈 très important

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Redéfinir le nom du mot de passe si ce n'est pas "password"
    public function getAuthPassword()
    {
        return $this->password;
    }

    public function videos()
{
    return $this->hasMany(Video::class, 'user_id', 'idUser');
}

// Relation supprimée car pas de classe_id dans la table users
}