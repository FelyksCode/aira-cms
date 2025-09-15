<?php

namespace App\Filament\Resources\AiFeatures\Pages;

use App\Filament\Resources\AiFeatures\AiFeatureResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAiFeature extends ViewRecord
{
    protected static string $resource = AiFeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
