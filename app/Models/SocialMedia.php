<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $table = 'social_media';

    protected $fillable = [
        'platform',
        'account_name',
        'url',
        'icon_class',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
