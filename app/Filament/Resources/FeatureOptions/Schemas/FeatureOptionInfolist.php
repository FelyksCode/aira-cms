<?php

namespace App\Filament\Resources\FeatureOptions\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FeatureOptionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('ai_feature_id')
                    ->numeric(),
                TextEntry::make('cancer_id')
                    ->numeric(),
                TextEntry::make('key'),
                TextEntry::make('label'),
                IconEntry::make('require_csv')
                    ->boolean(),
                IconEntry::make('require_img')
                    ->boolean(),
                TextEntry::make('ai_model_name'),
                TextEntry::make('ai_data_type'),
                TextEntry::make('sample_dataset_url')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
