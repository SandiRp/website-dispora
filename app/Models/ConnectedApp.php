<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConnectedApp extends Model
{
    protected $fillable = [
        'name',
        'description',
        'url_link',
        'logo_path',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
