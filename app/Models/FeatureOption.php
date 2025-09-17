<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'ai_feature_id',
        'cancer_id',
        'key',
        'label',
        'require_csv',
        'require_img',
        'ai_model_name',
        'ai_data_type',
        'sample_dataset_url'
    ];

    protected $casts = [
        'require_csv' => 'boolean',
        'require_img' => 'boolean',
    ];


    public function aiFeature()
    {
        return $this->belongsTo(AiFeature::class);
    }

    public function cancer()
    {
        return $this->belongsTo(Cancer::class);
    }
}
