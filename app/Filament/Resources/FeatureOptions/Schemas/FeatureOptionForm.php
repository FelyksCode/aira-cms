<?php

namespace App\Filament\Resources\FeatureOptions\Schemas;

use App\Models\FeatureOption;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;
use Filament\Schemas\Schema;

class FeatureOptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('ai_feature_id')
                    ->relationship("aiFeature", "name")
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('cancer_id')
                    ->relationship("cancer", "name")
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('label')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(string $context, $state, Set $set) => $context === 'create' || $context === 'edit' ? $set('key', Str::slug($state)) : null),


                TextInput::make('key')
                    ->required()
                    ->unique(FeatureOption::class, 'key', ignoreRecord: true),

                Toggle::make('require_csv')
                    ->label('Require CSV'),

                Toggle::make('require_img')
                    ->label('Require Image')
                    ->rules([
                        function ($attribute, $value, $fail) {
                            if (! request('require_csv') && ! request('require_img')) {
                                $fail('At least one option must be selected.');
                            }
                        },
                    ]),

                TextInput::make('ai_model_name')
                    ->label("AI Model Name")
                    ->required(),
                TextInput::make('ai_data_type')
                    ->label("AI Data Type")
                    ->required(),
                TextInput::make('sample_dataset_url')
                    ->label("Sample Dataset URL")
                    ->url(),
            ]);
    }
}
