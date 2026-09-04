<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkmData extends Model
{
    protected $fillable = [
        'year',
        'period',
        'index_value',
        'category',
        'document_path',
        'is_published',
        'is_active',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_active' => 'boolean',
        'index_value' => 'decimal:2',
    ];
}
