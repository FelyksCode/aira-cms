<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiFeature extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'name', 'description'];

    public function featureOptions()
    {
        return $this->hasMany(FeatureOption::class);
    }
}
