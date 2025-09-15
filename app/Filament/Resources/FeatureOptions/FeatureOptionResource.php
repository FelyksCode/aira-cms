<?php

namespace App\Filament\Resources\FeatureOptions;

use App\Filament\Resources\FeatureOptions\Pages\CreateFeatureOption;
use App\Filament\Resources\FeatureOptions\Pages\EditFeatureOption;
use App\Filament\Resources\FeatureOptions\Pages\ListFeatureOptions;
use App\Filament\Resources\FeatureOptions\Pages\ViewFeatureOption;
use App\Filament\Resources\FeatureOptions\Schemas\FeatureOptionForm;
use App\Filament\Resources\FeatureOptions\Schemas\FeatureOptionInfolist;
use App\Filament\Resources\FeatureOptions\Tables\FeatureOptionsTable;
use App\Models\FeatureOption;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class FeatureOptionResource extends Resource
{
    protected static ?string $model = FeatureOption::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cog6Tooth;

    protected static string | UnitEnum | null $navigationGroup = 'Data';

    public static function form(Schema $schema): Schema
    {
        return FeatureOptionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FeatureOptionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FeatureOptionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFeatureOptions::route('/'),
            'create' => CreateFeatureOption::route('/create'),
            'view' => ViewFeatureOption::route('/{record}'),
            'edit' => EditFeatureOption::route('/{record}/edit'),
        ];
    }
}
