<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    protected $fillable = ['user_id', 'title', 'file_path'];
    
    public function getVideoUrlAttribute()
    {
        return Storage::url($this->file_path);
    }
}