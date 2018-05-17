<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Lab extends Model
{
    protected $fillable = [
        'title', 'difficulty', 'description', 'objective', 'instruction', 'is_predefined_lab', 'is_published', 'quota'
    ];

    protected $attributes = [
        'material_files' => '[]',
        'quota' => '{"instances":0,"vcpus":0,"memory":0,"disk":0}'
    ];

    protected $casts = [
        'quota' => 'object',
        'material_files' => 'array'
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopePreDefinedLab($query)
    {
    	return $query->where('is_predefined_lab' ,true);
    }

	public function scopeNotDefinedLab($query)
	{
		return $query->where('is_predefined_lab' ,0);
	}

    public function getFormattedMaterialFilesAttribute()
    {
        $formattedFileList = [];
        
        foreach ($this->material_files as $file) {
            $formattedFileList[] = [
                'name' => $file['name'],
                'url' => Storage::url($file['path']),
                'size' => Storage::size($file['path'])
            ];
        }

        return collect($formattedFileList);
    }

    public function users()
    {
    	return $this->hasMany(User::class);
    }
}
