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

        $this->call([
            CategorySeeder::class   
        ]);
        // 1. Membuat Role Awal
        $roleAdmin = Role::findOrCreate('Super Admin');
        $rolePPID = Role::findOrCreate('Admin PPID');
        $roleStaf = Role::findOrCreate('Staf Dispora');

        // 2. Membuat Akun Super Admin
         $users = [
            [
                'name' => 'admin',
                'email' => 'admin@dispora.jatimprov.go.id',
                'password' => Hash::make('D1spora@man2026!'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'IRFP.',
                'email' => 'irfp@dispora.jatimprov.go.id',
                'password' => Hash::make('D1spora@man2026!'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'SRP',
                'email' => 'srp@dispora.jatimprov.go.id',
                'password' => Hash::make('D1spora@man2026!'),
                'email_verified_at' => now(),
            ],
        ];
         foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                $userData
            );
            $user->assignRole($roleAdmin);
        }

    }
}
