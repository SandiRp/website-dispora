<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_open_user_management_and_reset_a_password(): void
    {
        $superAdmin = User::factory()->create();
        $target = User::factory()->create();
        $superAdmin->assignRole(Role::findOrCreate('Super Admin'));

        $this->actingAs($superAdmin)
            ->get(route('admin.users.index'))
            ->assertOk()
            ->assertSee($target->email);

        $this->actingAs($superAdmin)
            ->put(route('admin.users.password.update', $target), [
                'password' => 'PasswordBaru123!',
                'password_confirmation' => 'PasswordBaru123!',
            ])
            ->assertRedirect(route('admin.users.index'))
            ->assertSessionHasNoErrors();

        $this->assertTrue(Hash::check('PasswordBaru123!', $target->fresh()->password));
    }

    public function test_admin_ppid_can_manage_content_but_cannot_manage_users(): void
    {
        $adminPpid = User::factory()->create();
        $adminPpid->assignRole(Role::findOrCreate('Admin PPID'));

        $this->actingAs($adminPpid)
            ->get(route('admin.posts.index'))
            ->assertOk();

        $this->actingAs($adminPpid)
            ->get(route('admin.users.index'))
            ->assertForbidden();
    }
}
