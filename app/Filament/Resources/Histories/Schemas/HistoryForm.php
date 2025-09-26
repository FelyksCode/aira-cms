<?php

namespace App\Filament\Resources\Histories\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class HistoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('input')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('ai_feture_options_id')
                    ->required()
                    ->numeric(),
                TextInput::make('ip_address'),
                DateTimePicker::make('timestamp')
                    ->required(),
                Textarea::make('results')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
