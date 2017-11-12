<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $fillable = ['title', 'difficulty', 'description', 'instruction'];

    protected $casts = [
        'quota' => 'object'
    ];
}
