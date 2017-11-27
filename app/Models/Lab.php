<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $fillable = ['title', 'difficulty', 'description', 'instruction', 'predefined_lab', 'publish'];

    protected $casts = [
        'quota' => 'object'
    ];
}
