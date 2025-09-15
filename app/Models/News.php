<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'image_url',
        'source_url',
        'created_by'
    ];

    function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            NewsCategory::class,
            'news_news_category'
        )
            ->withTimestamps();
    }
}
