<?php

namespace App\Filament\Resources\News\Pages;

use App\Filament\Resources\News\NewsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNews extends CreateRecord
{
    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected static string $resource = NewsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
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
