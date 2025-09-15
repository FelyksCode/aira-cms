<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class NewsCategory extends Model
{
    protected $fillable = [
        "name",
    ];

    function news(): BelongsToMany
    {
        return $this->belongsToMany(
            News::class,
            'news_news_category'
        )
            ->withTimestamps();
    }
}
