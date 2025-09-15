<?php

namespace App\Filament\Resources\AiFeatures;

use App\Filament\Resources\AiFeatures\Pages\CreateAiFeature;
use App\Filament\Resources\AiFeatures\Pages\EditAiFeature;
use App\Filament\Resources\AiFeatures\Pages\ListAiFeatures;
use App\Filament\Resources\AiFeatures\Pages\ViewAiFeature;
use App\Filament\Resources\AiFeatures\RelationManagers\FeatureOptionsRelationManager;
use App\Filament\Resources\AiFeatures\Schemas\AiFeatureForm;
use App\Filament\Resources\AiFeatures\Schemas\AiFeatureInfolist;
use App\Filament\Resources\AiFeatures\Tables\AiFeaturesTable;
use App\Models\AiFeature;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AiFeatureResource extends Resource
{
    protected static ?string $model = AiFeature::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ListBullet;

    protected static ?string $navigationLabel = 'AI Features';

    protected static ?string $title = 'AI Features';

    protected static string | UnitEnum | null $navigationGroup = 'Data';

    public static function form(Schema $schema): Schema
    {
        return AiFeatureForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AiFeatureInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AiFeaturesTable::configure($table);
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
            'index' => ListAiFeatures::route('/'),
            'create' => CreateAiFeature::route('/create'),
            'view' => ViewAiFeature::route('/{record}'),
            'edit' => EditAiFeature::route('/{record}/edit'),
        ];
    }
}
