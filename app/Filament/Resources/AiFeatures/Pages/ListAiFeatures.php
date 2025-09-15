<?php

namespace App\Filament\Resources\AiFeatures\Pages;

use App\Filament\Resources\AiFeatures\AiFeatureResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAiFeatures extends ListRecords
{
    protected static string $resource = AiFeatureResource::class;

    protected static ?string $title = "AI Features";

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label("Insert a new AI Feature"),
        ];
    }
}
