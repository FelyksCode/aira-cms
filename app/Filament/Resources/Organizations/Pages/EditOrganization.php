<?php

namespace App\Filament\Resources\Organizations\Pages;

use App\Filament\Resources\Organizations\OrganizationResource;
use App\Models\Organization;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRElement\FHIRAddress;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRElement\FHIRBackboneElement\FHIROrganization\FHIROrganizationContact;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRElement\FHIRBoolean;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRElement\FHIRCodeableConcept;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRElement\FHIRCoding;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRElement\FHIRContactPoint;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRElement\FHIRHumanName;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRElement\FHIRIdentifier;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRElement\FHIRReference;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRElement\FHIRString;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRResource\FHIRDomainResource\FHIROrganization;

class EditOrganization extends EditRecord
{
    protected static string $resource = OrganizationResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // decode JSON into array for the form
        $json = $this->record->json;

        if (is_string($json)) {
            $json = json_decode($json, true) ?? [];
        }

        // Normalize partOf for Select field
        if (isset($json['partOf']['id'])) {
            // Force the Select value to the "id" (Organization/xx)
            $json['partOf']['reference'] = $json['partOf']['id'];
        }

        // merge DB columns + JSON blob into one array for the form
        return array_merge($data, $json);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Set Org Name
        $fhir_org = new FHIROrganization(
            name: $data['name'],
        );

        // Set Org active
        $fhir_org->setActive((bool) $data['active']);

        // Set Org Alias
        if (!empty($data['alias'])) {
            foreach ($data['alias'] as $alias) {
                if ($alias) {
                    $fhir_org->addAlias(new FHIRString(value: $alias));
                }
            }
        }


        // Set Org Types
        if (!empty($data['type'])) {
            foreach ($data['type'] as $typeItem) {
                if (!empty($typeItem['coding'])) {
                    $concept = new FHIRCodeableConcept();

                    foreach ($typeItem['coding'] as $coding) {
                        if (!empty($coding['code'])) {
                            $concept->addCoding(new FHIRCoding(
                                system: $coding['system'] ?? null,
                                code: $coding['code'] ?? null,
                                display: $coding['display'] ?? null,
                            ));
                        }
                    }

                    $fhir_org->addType($concept);
                }
            }
        }

        // Set Org Identifier
        if (!empty($data['identifier'])) {
            foreach ($data['identifier'] as $identifier) {
                if (!empty($identifier['use'])) {
                    $fhir_org->addIdentifier(
                        new FHIRIdentifier(
                            use: $identifier['use'],
                            value: $identifier['value'] ?? null,
                            system: $identifier['system'] ?? null,
                        )
                    );
                }
            }
        }

        // Set Org Contact
        if (!empty($data['contact'])) {
            foreach ($data['contact'] as $contact) {
                if (!empty($contact['purpose']['coding'][0]['code'])) {
                    $orgContact = new FHIROrganizationContact();

                    // Name
                    if (!empty($contact['name'][0]['text'])) {
                        $orgContact->setName(new FHIRHumanName(text: $contact['name'][0]['text']));
                    }

                    // Purpose
                    $purpose = new FHIRCodeableConcept();
                    foreach ($contact['purpose']['coding'] as $coding) {
                        $purpose->addCoding(new FHIRCoding(
                            system: $coding['system'] ?? null,
                            code: $coding['code'] ?? null,
                            display: $coding['display'] ?? null,
                        ));
                    }
                    $orgContact->setPurpose($purpose);

                    // Telecoms
                    if (!empty($contact['telecom'])) {
                        foreach ($contact['telecom'] as $t) {
                            if (!empty($t['system'])) {
                                $orgContact->addTelecom(new FHIRContactPoint(
                                    system: $t['system'],
                                    value: $t['value'] ?? null,
                                    use: $t['use'] ?? null,
                                ));
                            }
                        }
                    }

                    // Address
                    if (!empty($contact['address'])) {
                        $address = new FHIRAddress();
                        if (!empty($contact['address']['line'])) {
                            // $address->addLine(new FHIRString(value: $contact['address']['line']));
                        }
                        $address->setCity($contact['address']['city'] ?? null);
                        $address->setPostalCode($contact['address']['postalCode'] ?? null);
                        $address->setCountry($contact['address']['country'] ?? null);

                        $orgContact->setAddress($address);
                    }

                    $fhir_org->addContact($orgContact);
                }
            }
        }

        // Set Org PartOf
        if (!empty($data['partOf']['reference'])) {
            $org_ref_id = str_replace("Organization/", "", $data['partOf']['reference']);
            $org_ref = Organization::find($org_ref_id);
            $org_ref =  is_string($org_ref->json) ? json_decode($org_ref->json, true) : $org_ref->json;

            $org_ref_name = $org_ref["name"];

            $fhir_org->setPartOf(
                new FHIRReference(
                    id: $data['partOf']['reference'],
                    reference: $org_ref_name,
                    display: $org_ref_name,
                )
            );
        }

        // Return JSON-encoded FHIR Organization back into `json` column
        $data['json'] = $fhir_org->jsonSerialize();

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
