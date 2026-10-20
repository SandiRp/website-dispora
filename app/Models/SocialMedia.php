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
        'custom_logo_path',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getLogoUrlAttribute(): ?string
    {
        return $this->custom_logo_path ? \Illuminate\Support\Facades\Storage::url($this->custom_logo_path) : null;
    }
}
