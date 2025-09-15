<?php

namespace App\Filament\Resources\Banners\Schemas;

use App\Models\Banner;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('body')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image_url')
                    ->label("Banner Image")
                    ->image()
                    ->required(),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(fn() => Banner::max('order') + 1)
                    ->minValue(1),
                Toggle::make('visible')
                    ->label('Show on Homepage')
                    ->default(true),
            ]);
    }
}
