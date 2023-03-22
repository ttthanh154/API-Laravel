<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Test',
            'email' => 'admin@admin.com',
            'gender' => 'male',
            'role' => 'super admin',
            'birth_date' => '2001-03-20',
            'status' => 'active',
            'password' => Hash::make('admin@1234'),
        ]);

        $user->assignRole('super admin');
    }
}
