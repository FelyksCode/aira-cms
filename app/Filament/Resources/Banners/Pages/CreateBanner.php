<?php

namespace App\Filament\Resources\Banners\Pages;

use App\Filament\Resources\Banners\BannerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBanner extends CreateRecord
{
    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected static string $resource = BannerResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (!empty($data['image_url']) && is_file($data['image_url'])) {
            $data['image_url'] = file_get_contents($data['image_url']);
        }

        return $data;
    }
}
