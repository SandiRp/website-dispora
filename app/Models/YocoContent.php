<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YocoContent extends Model
{
    public const TYPE_SOSIALISASI = 'sosialisasi';
    public const TYPE_ADVOKASI = 'advokasi';
    public const TYPE_MARKETING = 'marketing';
    public const TYPE_APLIKASI = 'aplikasi';

    public static function types(): array
    {
        return [
            self::TYPE_SOSIALISASI => 'Sosialisasi',
            self::TYPE_ADVOKASI => 'Advokasi',
            self::TYPE_MARKETING => 'Marketing',
            self::TYPE_APLIKASI => 'Uji Coba Aplikasi',
        ];
    }

    protected $fillable = [
        'type',
        'title',
        'content',
        'image_path',
        'link_url',
        'link_label',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function getTypeLabelAttribute(): string
    {
        return self::types()[$this->type] ?? ucfirst($this->type);
    }
}

