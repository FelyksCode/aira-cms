<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('role.name')
                    ->label('Role')
                    ->searchable(),
                TextColumn::make('organization.json')
                    ->label('Organization')
                    ->getStateUsing(
                        fn($record) => $record->organization
                            ? data_get($record->organization->json, 'name', '-')
                            : '-'
                    )
                    ->searchable(
                        query: function ($query, $search) {
                            $query->whereHas('organization', function ($q) use ($search) {
                                $q->whereRaw(
                                    "LOWER(json_extract(json(json), '$.name')) LIKE ?",
                                    ['%' . strtolower($search) . '%']
                                );
                            });
                        }
                    )
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->alignCenter(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make("role")->relationship('role', 'name'),
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
