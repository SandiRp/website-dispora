<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficialLogo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'file_path',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
