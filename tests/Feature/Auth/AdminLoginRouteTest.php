<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminLoginRouteTest extends TestCase
{
    use RefreshDatabase;

    public function test_old_login_route_is_not_available(): void
    {
        $this->get('/login')->assertNotFound();
        $this->post('/login')->assertNotFound();
    }

    public function test_guest_is_redirected_to_login2026_when_opening_admin_page(): void
    {
        $this->get(route('admin.posts.index'))
            ->assertRedirect(route('login'));

        $this->assertSame(url('/login2026'), route('login'));
    }

    public function test_logout_redirects_to_login2026(): void
    {
        $user = User::factory()->create();
        $user->assignRole(Role::findOrCreate('Admin PPID'));

        $this->actingAs($user)
            ->post(route('logout'))
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }
}
