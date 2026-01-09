<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder; // <-- Make sure to import the User model here
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'ilpp.infodesk@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('ILPP@2025'),
            ]
        );
    }
}
