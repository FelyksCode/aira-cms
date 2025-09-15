<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cancer extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'name', 'description'];

    public function featureOptions()
    {
        return $this->hasMany(FeatureOption::class);
    }
}
