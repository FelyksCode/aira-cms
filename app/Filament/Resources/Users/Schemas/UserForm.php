<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\Role;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('role_id')
                    ->options(
                        fn() => Role::all()->pluck('name', 'id')->toArray()
                    )
                    ->default(
                        fn() => Role::where('name', 'user')->first()?->id
                    )
                    // hidden if user role user
                    ->hidden(
                        fn(?User $record) => auth()->user()->role->name === 'user' && $record?->role->name === 'user'
                    )
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->required(),
            ]);
    }
}
