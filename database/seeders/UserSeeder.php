<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(CategorySeeder::class);

        $adminPpid = Role::findOrCreate('Admin PPID', 'web');

        $users = [
            [
                'name' => 'IRFP',
                'email' => 'irfp@dispora.jatimprov.go.id',
                'password' => 'D1spora@man2026!',
            ],
            [
                'name' => 'SRP',
                'email' => 'srp@dispora.jatimprov.go.id',
                'password' => 'D1spora@man2026!',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']),
                    'email_verified_at' => now(),
                ],
            );

            $user->syncRoles([$adminPpid]);
        }
    }
}
