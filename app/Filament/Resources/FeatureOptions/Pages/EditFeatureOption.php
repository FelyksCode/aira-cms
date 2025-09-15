<?php

namespace App\Filament\Resources\FeatureOptions\Pages;

use App\Filament\Resources\FeatureOptions\FeatureOptionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditFeatureOption extends EditRecord
{
    protected static string $resource = FeatureOptionResource::class;

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
