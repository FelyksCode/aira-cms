<?php

namespace App\Filament\Resources\FeatureOptions\Pages;

use App\Filament\Resources\FeatureOptions\FeatureOptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFeatureOptions extends ListRecords
{
    protected static string $resource = FeatureOptionResource::class;

    protected static ?string $title = 'Feature Options';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label("Insert a new Feature Option"),
        ];
    }
}
