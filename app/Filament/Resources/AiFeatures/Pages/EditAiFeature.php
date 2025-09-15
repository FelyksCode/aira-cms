<?php

namespace App\Filament\Resources\AiFeatures\Pages;

use App\Filament\Resources\AiFeatures\AiFeatureResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAiFeature extends EditRecord
{
    protected static string $resource = AiFeatureResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
