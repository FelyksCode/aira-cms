<?php

namespace App\Filament\Resources\Organizations\Pages;

use App\Filament\Resources\Organizations\OrganizationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewOrganization extends ViewRecord
{
    protected static string $resource = OrganizationResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // decode JSON into array for the form
        $json = $this->record->json;

        if (is_string($json)) {
            $json = json_decode($json, true) ?? [];
        }

        // merge DB columns + JSON blob into one array for the form
        return array_merge($data, $json);
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
