<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Role create admin and user
        Role::create(['name' => 'user']);
        Role::create(['name' => 'admin']);

        User::factory()->create([
            'role_id' => Role::where('name', 'admin')->first()->id,
            'name' => config('user.name'),
            'email' => config('user.email'),
            'password' => Hash::make(config('user.password')),
        ]);
    }
}
