<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_able_to_find_a_post(): void
    {
        $post = Post::factory()->create();

        $response = $this->get(route('posts.show', $post));

        $response
            ->assertStatus(200)
            ->assertJson($post->only('title', 'highlight', 'content'));
    }

    /**
     * @test
     */
    public function it_able_to_store_a_post(): void
    {
        $attributes = [
            'title' => 'post title', 
            'highlight' => 'post highlight', 
            'content' => 'post content'
        ];

        $response = $this->post(route('posts.store', $attributes));

        $response->assertNoContent();

        $this->assertDatabaseHas('posts', $attributes);
    }
}
