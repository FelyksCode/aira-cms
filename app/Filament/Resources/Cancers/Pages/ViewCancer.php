<?php

namespace App\Filament\Resources\Cancers\Pages;

use App\Filament\Resources\Cancers\CancerResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCancer extends ViewRecord
{
    protected static string $resource = CancerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
