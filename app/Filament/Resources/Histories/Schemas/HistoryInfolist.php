<?php

namespace App\Filament\Resources\Histories\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class HistoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('input')
                    ->columnSpanFull(),
                TextEntry::make('ai_feture_options_id')
                    ->numeric(),
                TextEntry::make('ip_address')
                    ->placeholder('-'),
                TextEntry::make('timestamp')
                    ->dateTime(),
                TextEntry::make('results')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
