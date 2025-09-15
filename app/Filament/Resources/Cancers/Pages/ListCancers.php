<?php

namespace App\Filament\Resources\Cancers\Pages;

use App\Filament\Resources\Cancers\CancerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCancers extends ListRecords
{
    protected static string $resource = CancerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label("Insert a new Cancer Type"),
        ];
    }
}
