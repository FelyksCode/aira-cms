<?php

namespace App\Filament\Resources\Cancers\Pages;

use App\Filament\Resources\Cancers\CancerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCancer extends CreateRecord
{
    protected static string $resource = CancerResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
