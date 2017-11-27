<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $fillable = [
        'title', 'difficulty', 'description', 'objective', 'instruction', 'predefined_lab', 'publish'
    ];

    protected $casts = [
        'quota' => 'object'
    ];
}
