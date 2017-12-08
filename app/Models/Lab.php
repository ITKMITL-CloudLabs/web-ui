<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Lab extends Model
{
    protected $fillable = [
        'title', 'difficulty', 'description', 'objective', 'instruction', 'is_predefined_lab', 'is_published', 'quota'
    ];

    protected $casts = [
        'quota' => 'object',
        'material_files' => 'array'
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function getMaterialFilesAttribute($fileList)
    {
        $fileList = json_decode($fileList);
        $formattedFileList = [];

        foreach ($fileList as $file) {
            $formattedFileList[] = [
                'name' => $file->name,
                'url' => Storage::url($file->path),
                'size' => Storage::size($file->path)
            ];
        }

        return collect($formattedFileList);
    }
}
