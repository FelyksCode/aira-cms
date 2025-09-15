<?php

namespace App\Filament\Resources\FeatureOptions\Pages;

use App\Filament\Resources\FeatureOptions\FeatureOptionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFeatureOption extends ViewRecord
{
    protected static string $resource = FeatureOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
