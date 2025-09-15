<?php

namespace App\Filament\Resources\AiFeatures\Pages;

use App\Filament\Resources\AiFeatures\AiFeatureResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAiFeature extends CreateRecord
{
    protected static string $resource = AiFeatureResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
