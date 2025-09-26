<?php

namespace App\Filament\Resources\Histories;

use App\Filament\Resources\Histories\Pages\CreateHistory;
use App\Filament\Resources\Histories\Pages\EditHistory;
use App\Filament\Resources\Histories\Pages\ListHistories;
use App\Filament\Resources\Histories\Pages\ViewHistory;
use App\Filament\Resources\Histories\Schemas\HistoryForm;
use App\Filament\Resources\Histories\Schemas\HistoryInfolist;
use App\Filament\Resources\Histories\Tables\HistoriesTable;
use App\Models\History;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class HistoryResource extends Resource
{
    protected static ?string $model = History::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string | UnitEnum | null $navigationGroup = 'Data';

    public static function form(Schema $schema): Schema
    {
        return HistoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return HistoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HistoriesTable::configure($table);
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
            'index' => ListHistories::route('/'),
            // 'create' => CreateHistory::route('/create'),
            'view' => ViewHistory::route('/{record}'),
            // 'edit' => EditHistory::route('/{record}/edit'),
        ];
    }
}
