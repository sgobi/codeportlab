<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'gobi@codeportlab.com'],
            [
                'name' => 'Gobikrishna Subramaniyam',
                'password' => Hash::make('CodePortLab2026!'),
                'email_verified_at' => now(),
            ]
        );
    }
}
