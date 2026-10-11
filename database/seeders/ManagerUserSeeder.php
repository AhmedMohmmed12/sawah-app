<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ManagerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(['email' => 'manager@sawah.com'], [
            'name' => 'Manager User',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'email_verified_at' => now(),
        ]);

        if (! $user->wasRecentlyCreated) {
            $this->command->info('Manager user already exists, left unchanged.');

            return;
        }

        $this->command->info('Manager user created successfully!');
        $this->command->info('Email: manager@sawah.com');
        $this->command->info('Password: password');
    }
}
