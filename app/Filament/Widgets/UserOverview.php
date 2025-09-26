<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserOverview extends StatsOverviewWidget
{
    protected ?string $heading = 'Analytics';

    protected ?string $description = 'An overview of some analytics.';

    protected ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        return [
            Stat::make("User Count", User::count()),
            // Add more Stat or Chart if needed
        ];
    }

    // Show widget if role admin
    public static function canView(): bool
    {
        return auth()->user()?->hasRole('admin');
    }
}
