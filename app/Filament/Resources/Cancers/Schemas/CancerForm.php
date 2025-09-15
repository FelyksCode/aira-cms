<?php

namespace App\Filament\Resources\Cancers\Schemas;

use App\Models\Cancer;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CancerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label("Cancer Name")
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(string $context, $state, Set $set) => $context === 'create' || $context === 'edit' ? $set('slug', Str::slug(explode(' ', $state)[0])) : null),

                TextInput::make('slug')
                    ->required()
                    ->unique(Cancer::class, 'slug', ignoreRecord: true),

                Textarea::make('description')
                    ->columnSpanFull(),

            ]);
    }
}
