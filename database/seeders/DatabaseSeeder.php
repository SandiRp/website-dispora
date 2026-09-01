<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Membuat Role Awal
        $roleAdmin = Role::findOrCreate('Super Admin');
        $rolePPID = Role::findOrCreate('Admin PPID');
        $roleStaf = Role::findOrCreate('Staf Dispora');

        // 2. Membuat Akun Super Admin
        $admin = User::create([
            'name' => 'Sandi R.P.',
            'email' => 'admin@dispora.jatimprov.go.id',
            'password' => Hash::make('D1spora@man2026!'),
            'email_verified_at' => now(),
        ]);

        // 3. Menugaskan Role ke Akun
        $admin->assignRole($roleAdmin);
    }
}
