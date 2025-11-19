<?php

namespace App\Filament\Resources\News\Pages;

use App\Filament\Resources\News\NewsResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditNews extends EditRecord
{
    protected static string $resource = NewsResource::class;

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

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data = $this->processBlobImage($data);
        return $data;
    }

    private function processBlobImage(array $data): array
    {
        if (!empty($data['image_url'])) {
            $tmpDir = storage_path('app/private/');

            $matches = glob($tmpDir . $data['image_url']);

            if (!empty($matches)) {
                
                $tempPath = $matches[0];
                $data['image_url'] = file_get_contents($tempPath);
            }
        }

        return $data;
    }
}
