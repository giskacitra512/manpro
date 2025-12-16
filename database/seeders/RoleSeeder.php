<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Roles
        $adminRole = Role::create([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'Administrator with full access to manage the system',
        ]);

        $mahasiswaRole = Role::create([
            'name' => 'mahasiswa',
            'display_name' => 'Mahasiswa',
            'description' => 'Student with access to view and download materials',
        ]);

        // Create Admin User
        User::create([
            'name' => 'Admin Brain',
            'email' => 'admin@Brain.com',
            'password' => Hash::make('password123'),
            'role_id' => $adminRole->id,
        ]);

        // Create Sample Mahasiswa
        User::create([
            'name' => 'Mahasiswa Demo',
            'email' => 'mahasiswa@Brain.com',
            'password' => Hash::make('password123'),
            'role_id' => $mahasiswaRole->id,
        ]);
    }
}
