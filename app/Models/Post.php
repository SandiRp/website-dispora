<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'content',
        'featured_image',
        'status',
        'published_date',
        'views_count'
    ];

    protected $casts = [
        'published_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getDisplayDateAttribute()
    {
        return $this->published_date ? $this->published_date : $this->created_at;
    }

    public function scopeLatestPublished($query)
    {
        return $query->where('status', 'published')
            ->orderByRaw('COALESCE(published_date, DATE(created_at)) DESC, created_at DESC');
    }
}
