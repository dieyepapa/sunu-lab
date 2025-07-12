<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    // Tu peux laisser vide ou ajouter des cookies à exclure du chiffrement
    protected $except = [
        //
    ];
}