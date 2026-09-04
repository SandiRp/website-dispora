<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = [
        'name',
        'image_path',
        'short_description',
        'description',
        'pic_name',
        'pic_phone',
        'is_active',
        'order',
    ];
}
