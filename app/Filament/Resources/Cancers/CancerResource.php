<?php

namespace App\Filament\Resources\Cancers;

use App\Filament\Resources\AiFeatures\RelationManagers\FeatureOptionsRelationManager;
use App\Filament\Resources\Cancers\Pages\CreateCancer;
use App\Filament\Resources\Cancers\Pages\EditCancer;
use App\Filament\Resources\Cancers\Pages\ListCancers;
use App\Filament\Resources\Cancers\Pages\ViewCancer;
use App\Filament\Resources\Cancers\Schemas\CancerForm;
use App\Filament\Resources\Cancers\Schemas\CancerInfolist;
use App\Filament\Resources\Cancers\Tables\CancersTable;
use App\Models\Cancer;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CancerResource extends Resource
{
    protected static ?string $model = Cancer::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Tag;

    protected static ?string $recordTitleAttribute = 'Cancer';

    protected static string | UnitEnum | null $navigationGroup = 'Data';

    public static function form(Schema $schema): Schema
    {
        return CancerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CancerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CancersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            FeatureOptionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCancers::route('/'),
            'create' => CreateCancer::route('/create'),
            'view' => ViewCancer::route('/{record}'),
            'edit' => EditCancer::route('/{record}/edit'),
        ];
    }
}
