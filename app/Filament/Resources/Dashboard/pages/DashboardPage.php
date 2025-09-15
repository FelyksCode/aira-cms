<?php

namespace App\Filament\Resources\Dashboard\pages;

use Filament\Pages\Dashboard;
use Filament\Support\Icons\Heroicon;
use BackedEnum;

class DashboardPage extends Dashboard
{
    protected static ?string $title = 'Dashboard';

    protected static string | BackedEnum | null $navigationIcon = Heroicon::Home;
}
