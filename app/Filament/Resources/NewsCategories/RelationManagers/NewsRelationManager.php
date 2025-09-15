<?php

namespace App\Filament\Resources\NewsCategories\RelationManagers;

use App\Filament\Resources\News\NewsResource;
use Filament\Actions\CreateAction;
use Filament\Actions\DetachAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class NewsRelationManager extends RelationManager
{
    protected static string $relationship = 'news';

    protected static ?string $relatedResource = NewsResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->recordActions([
                EditAction::make(),
                DetachAction::make(),
            ]);
    }
}
