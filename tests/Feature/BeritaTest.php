<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BeritaTest extends TestCase
{
    use RefreshDatabase;

    public function test_ajax_category_filter_returns_only_the_requested_fragment(): void
    {
        $user = User::factory()->create();
        $pemuda = Category::create(['name' => 'KEPEMUDAAN', 'slug' => 'kepemudaan', 'type' => 'post']);
        $olahraga = Category::create(['name' => 'OLAHRAGA', 'slug' => 'olahraga', 'type' => 'post']);

        $this->createPost($user, $pemuda, 'Berita Pemuda', 'berita-pemuda');
        $this->createPost($user, $olahraga, 'Berita Olahraga', 'berita-olahraga');

        $this->get(route('berita.index', ['category' => 'olahraga']), [
            'X-Requested-With' => 'XMLHttpRequest',
        ])->assertOk()
            ->assertSee('data-berita-fragment', false)
            ->assertSee('Berita Olahraga')
            ->assertDontSee('Berita Pemuda')
            ->assertDontSee('<html', false);
    }

    public function test_ajax_pagination_keeps_category_query_string(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['name' => 'OLAHRAGA', 'slug' => 'olahraga', 'type' => 'post']);

        foreach (range(1, 11) as $number) {
            $this->createPost($user, $category, "Berita {$number}", "berita-{$number}");
        }

        $this->get(route('berita.index', ['category' => 'olahraga', 'page' => 1]), [
            'X-Requested-With' => 'XMLHttpRequest',
        ])->assertOk()
            ->assertSee('category=olahraga&amp;page=2', false);

        $this->get(route('berita.index', ['category' => 'olahraga', 'page' => 2]), [
            'X-Requested-With' => 'XMLHttpRequest',
        ])->assertOk()
            ->assertSee('data-berita-fragment', false);
    }

    public function test_opening_a_published_post_increments_its_view_count(): void
    {
        $user = User::factory()->create();
        $category = Category::create(['name' => 'OLAHRAGA', 'slug' => 'olahraga', 'type' => 'post']);
        $post = $this->createPost($user, $category, 'Berita Dilihat', 'berita-dilihat');

        $this->get(route('berita.detail', $post->slug))
            ->assertOk()
            ->assertSee('1 tayangan');
        $this->assertSame(1, $post->fresh()->views_count);

        $this->get(route('berita.detail', $post->slug))
            ->assertOk()
            ->assertSee('2 tayangan');
        $this->assertSame(2, $post->fresh()->views_count);
    }

    private function createPost(User $user, Category $category, string $title, string $slug): Post
    {
        return Post::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => $title,
            'slug' => $slug,
            'content' => "Isi {$title}",
            'status' => 'published',
            'published_date' => now()->toDateString(),
        ]);
    }
}
