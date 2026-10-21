<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_seeder_creates_admin_ppid_accounts_without_overwriting_existing_passwords(): void
    {
        $existing = User::factory()->create([
            'email' => 'irfp@dispora.jatimprov.go.id',
            'password' => Hash::make('password-lama'),
        ]);

        $this->seed(UserSeeder::class);
        $this->seed(UserSeeder::class);

        $this->assertDatabaseCount('users', 2);
        $this->assertTrue(Hash::check('password-lama', $existing->fresh()->password));
        $this->assertTrue($existing->fresh()->hasRole('Admin PPID'));
        $this->assertTrue(User::where('email', 'srp@dispora.jatimprov.go.id')->firstOrFail()->hasRole('Admin PPID'));
        $this->assertDatabaseHas('categories', ['slug' => 'olahraga', 'type' => 'post']);
    }
}
