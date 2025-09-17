<?php

namespace App\Filament\Resources\FeatureOptions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class FeatureOptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('aiFeature.name')
                    ->label("AI Feature Name")
                    ->sortable(),
                TextColumn::make('cancer.name')
                    ->label("Cancer Name")
                    ->sortable(),
                TextColumn::make('key')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                ToggleColumn::make('require_csv')
                    ->label('Require CSV')
                    ->alignCenter()
                    ->disabled(
                        fn($record): bool =>
                        $record->require_csv && ! $record->require_img
                    ),

                ToggleColumn::make('require_img')
                    ->label('Require IMG')
                    ->alignCenter()
                    ->disabled(
                        fn($record): bool =>
                        $record->require_img && ! $record->require_csv
                    ),

                TextColumn::make('ai_model_name')
                    ->label("AI Model Name")
                    ->searchable(),
                TextColumn::make('ai_data_type')
                    ->label("AI Data Type")
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('sample_dataset_url')
                    ->label("Sample Dataset URL")
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
