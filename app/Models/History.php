<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'input',
        /*
        input can be csv or image
        
            input: 
            {
                csv: 'path/to/file.csv',
                image: 'path/to/image.png',
            }
        */
        'ai_feture_options_id',
        'ip_address',
        'timestamp',
        'results',
        /*
        results stored in json for simplicity
        
            results: 
            {
               // Filled based on the ml results
            }
        */


    ];

    protected $cast = [
        'input' => 'array',
        'results' => 'array',
        'timestamp' => 'datetime',
    ];

    public function aiFeatureOption()
    {
        return $this->belongsTo(FeatureOption::class, 'ai_feture_options_id');
    }
}
