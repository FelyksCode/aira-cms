<?php

namespace App\Filament\Resources\AiFeatures\RelationManagers;

use App\Filament\Resources\FeatureOptions\FeatureOptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class FeatureOptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'featureOptions';

    protected static ?string $relatedResource = FeatureOptionResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make()->label("Insert a new Feature Option"),
            ]);
    }
}
