<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $fillable = [
        'title', 'difficulty', 'description', 'objective', 'instruction', 'predefined_lab', 'publish', 'quota'
    ];

    protected $casts = [
        'quota' => 'object'
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
