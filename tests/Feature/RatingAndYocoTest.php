<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RatingAndYocoTest extends TestCase
{
    use RefreshDatabase;

    public function test_visitor_can_submit_a_rating_with_an_optional_comment(): void
    {
        $this->postJson(route('ratings.store'), [
            'rating' => 5,
            'comment' => 'Informasinya mudah ditemukan.',
            'page_url' => 'https://example.test/berita',
        ])->assertCreated();

        $this->assertDatabaseHas('ratings', [
            'rating' => 5,
            'comment' => 'Informasinya mudah ditemukan.',
        ]);
    }

    public function test_yocopreneur_page_and_yoco_category_are_available(): void
    {
        $this->assertDatabaseHas('categories', ['slug' => 'yoco', 'type' => 'post']);

        $this->get(route('yocopreneur'))
            ->assertOk()
            ->assertSee('Yocopreneur')
            ->assertSee('Sosialisasi dan Advokasi');
    }

}
