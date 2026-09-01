<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
        'description'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
