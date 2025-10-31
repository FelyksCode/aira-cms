<?php

namespace App\Filament\Resources\Organizations\Schemas;

use App\Models\Organization;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrganizationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->schema([
                        Hidden::make('resourceType')
                            ->default("Organization"),

                        Toggle::make('active')
                            ->label('Active')
                            ->default(true),

                        TextInput::make('name')
                            ->label('Organization Name')
                            ->required(),

                        Repeater::make('alias')
                            ->label('Alias')
                            ->simple(
                                TextInput::make('value')
                                    ->label('Alias Name'),
                            ),
                    ]),

                Section::make('Organization Types')
                    ->collapsible()
                    ->schema([
                        Repeater::make('type')
                            ->schema([
                                Repeater::make('coding')
                                    ->schema([
                                        Grid::make(1)->schema([
                                            Select::make('code')
                                                ->label('Code')
                                                ->options([
                                                    'prov' => 'prov',
                                                    'dept' => 'dept',
                                                    'team' => 'team',
                                                    'govt' => 'govt',
                                                    'ins'  => 'ins',
                                                    'pay'  => 'pay',
                                                    'edu'  => 'edu',
                                                    'reli' => 'reli',
                                                    'crs'  => 'crs',
                                                    'cg'   => 'cg',
                                                    'bus'  => 'bus',
                                                    'ntwk' => 'ntwk',
                                                ])
                                                ->reactive()
                                                ->afterStateUpdated(function ($state, callable $set) {
                                                    $map = [
                                                        'prov' => 'Healthcare Provider',
                                                        'dept' => 'Hospital Department',
                                                        'team' => 'Organizational team',
                                                        'govt' => 'Government',
                                                        'ins'  => 'Insurance Company',
                                                        'pay'  => 'Payer',
                                                        'edu'  => 'Educational Institution',
                                                        'reli' => 'Religious Institution',
                                                        'crs'  => 'Clinical Research Sponsor',
                                                        'cg'   => 'Community Group',
                                                        'bus'  => 'Non-Healthcare Business or Corporation',
                                                        'ntwk' => 'Network',
                                                    ];

                                                    $set('display', $map[$state] ?? null);
                                                    if ($state) {
                                                        $set('system', 'http://terminology.hl7.org/CodeSystem/organization-type');
                                                    }
                                                }),

                                            TextInput::make('display')
                                                ->label('Display')
                                                ->disabled()
                                                ->dehydrated(true),

                                            TextInput::make('system')
                                                ->label('System')
                                                ->disabled()
                                                ->dehydrated(true),

                                        ]),
                                    ])
                                    ->itemLabel(
                                        fn(array $state): ?string =>
                                        $state["display"] ?? null
                                    )
                                    ->reorderableWithDragAndDrop(false)
                                    ->collapsible(true),
                            ])
                            ->reorderableWithDragAndDrop(false)
                            ->defaultItems(1),
                    ]),


                Section::make('Identifiers')
                    ->collapsible()
                    ->schema([
                        Repeater::make('identifier')
                            ->label("Organization Identifier")
                            ->schema([
                                Select::make('use')
                                    ->label('Use')
                                    ->options([
                                        'usual' => 'usual',
                                        'official' => 'official',
                                        'temp' => 'temp',
                                        'secondary' => 'secondary',
                                        'old' => 'old',
                                    ])
                                    ->live(onBlur: true)
                                    ->native(false)
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        $map = [
                                            'usual' => 'Usual',
                                            'official' => 'Official',
                                            'temp' => 'Temporary',
                                            'secondary' => 'Secondary',
                                            'old' => 'Old',
                                        ];

                                        $set('value', $map[$state] ?? null);
                                        if ($state) {
                                            $set('system', 'http://hl7.org/fhir/identifier-use');
                                        }
                                    }),
                                TextInput::make('system')
                                    ->label('System')
                                    ->disabled()
                                    ->dehydrated(true),

                                TextInput::make('value')
                                    ->label('Value')
                                    ->disabled()
                                    ->dehydrated(true),
                            ])->itemLabel(fn(array $state): ?string => 'Identifier ' . $state['use'] ?? null)
                            ->collapsible(true),
                    ]),


                Section::make('Contacts')
                    ->collapsible()
                    ->schema([
                        Repeater::make('contact')
                            ->label('Contacts')
                            ->collapsible()
                            ->schema([
                                // Contact Name
                                TextInput::make('name.0.text')
                                    ->label('Contact Name')
                                    ->live(onBlur: true),

                                // Purpose
                                Select::make('purpose.coding.0.code')
                                    ->label('Purpose')
                                    ->options([
                                        'ADMIN'   => 'Administrative',
                                        'PRESS'   => 'Press',
                                        'PATINF'  => 'Patient Information',
                                        'BILL'    => 'Billing',
                                        'HR'      => 'Human Resources',
                                    ])
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        $set('purpose.coding.0.system', 'http://terminology.hl7.org/CodeSystem/contactentity-type');

                                        $displayMap = [
                                            'ADMIN' => 'Administrative',
                                            'PRESS' => 'Press',
                                            'PATINFO' => 'Patient Information',
                                            'BILL' => 'Billing',
                                            'HR' => 'Human Resources',
                                        ];

                                        if (isset($displayMap[$state])) {
                                            $set('purpose.coding.0.display', $displayMap[$state]);
                                        }
                                    })
                                    ->native(false),

                                // Telecoms
                                Repeater::make('telecom')
                                    ->label('Telecoms')
                                    ->collapsible()
                                    ->schema([
                                        Select::make('system')
                                            ->label('System')
                                            ->options([
                                                'phone' => 'Phone',
                                                'fax'   => 'Fax',
                                                'email' => 'Email',
                                                'pager' => 'Pager',
                                                'url'   => 'URL',
                                                'sms'   => 'SMS',
                                                'other' => 'Other',
                                            ])
                                            ->native(false),

                                        TextInput::make('value')->label('Value')
                                            ->live(onBlur: true),

                                        Select::make('use')
                                            ->label('Use')
                                            ->options([
                                                'home'   => 'Home',
                                                'work'   => 'Work',
                                                'temp'   => 'Temporary',
                                                'old'    => 'Old',
                                                'mobile' => 'Mobile',
                                            ])
                                            ->native(false)
                                            ->nullable(),
                                    ])->itemLabel(
                                        fn(array $state): ?string =>
                                        $state["value"] ?? null
                                    ),

                                // Address
                                Section::make('Address')
                                    ->schema([
                                        Textarea::make('address.line')->label('Line'),
                                        TextInput::make('address.city')->label('City'),
                                        TextInput::make('address.postalCode')->label('Postal Code'),
                                        Select::make('address.country')
                                            ->label('Country')
                                            ->options([
                                                'ID' => 'Indonesia',
                                                'US' => 'United States',
                                                'SG' => 'Singapore',
                                                'JP' => 'Japan',
                                                // add more as needed
                                            ])
                                            ->searchable()
                                            ->placeholder('Select a country')
                                    ]),
                            ])
                            ->itemLabel(
                                fn(array $state): ?string =>
                                $state['name'][0]['text'] ?? $state['purpose']['coding'][0]['code'] ?? 'Contact'
                            ),
                    ]),

                Section::make('Hierarchy')
                    ->collapsible()
                    ->schema([
                        Select::make('partOf.reference')
                            ->label('Part Of')
                            ->searchable()
                            ->options(function ($get, $record) {
                                return Organization::query()
                                    ->when($record?->id, fn($q) => $q->where('id', '!=', $record->id))
                                    ->get()
                                    ->mapWithKeys(function ($org) {
                                        $json = is_string($org->json) ? json_decode($org->json, true) : $org->json;

                                        return [
                                            "Organization/{$org->id}" => $json["name"] ?? "Organization {$org->id}",
                                        ];
                                    })
                                    ->toArray();
                            })
                            ->placeholder('Select Parent Organization')
                            ->helperText('Indicates the parent organization this one is part of.'),
                    ]),

            ]);
    }
}
