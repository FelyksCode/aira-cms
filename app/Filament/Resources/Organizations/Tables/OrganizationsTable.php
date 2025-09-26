<?php

namespace App\Filament\Resources\Organizations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrganizationsTable
{
    public static function configure(Table $table): Table
    {


        return $table
            ->columns([
                TextColumn::make("id")
                    ->label("ID")
                    ->sortable()
                    ->searchable(),
                TextColumn::make('organization_name')
                    ->label('Organization Name')
                    ->getStateUsing(fn($record) => data_get($record->json, 'name'))
                    ->searchable(
                        query: function ($query, $search) {
                            $query->whereRaw(
                                "LOWER(JSON_UNQUOTE(JSON_EXTRACT(json, '$.name'))) LIKE ?",
                                ['%' . strtolower($search) . '%']
                            );
                        }
                    )

            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
