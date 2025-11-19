<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BannerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title'),
                TextEntry::make('body')
                    ->columnSpanFull(),
                ImageEntry::make('image_url')
                    ->placeholder('-')
                    ->getStateUsing(function ($record) {
                        if (!$record->image_url) {
                            return null;
                        }

                        $mime = $record->image_mime ?? 'image/jpeg';

                        return "data:{$mime};base64," . base64_encode($record->image_url);
                    }),
                TextEntry::make('order')
                    ->numeric(),
                IconEntry::make('visible')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
