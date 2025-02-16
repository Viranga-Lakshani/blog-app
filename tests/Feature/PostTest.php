<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_post()
    {
        $response = $this->post('/posts', [
            'title' => 'Test Title',
            'content' => 'Test content.',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('posts', ['title' => 'Test Title']);
    }

    public function test_read_post()
    {
        $post = Post::factory()->create();

        $response = $this->get('/posts/' . $post->id);

        $response->assertStatus(200);
        $response->assertSee($post->title);
    }

    public function test_update_post()
    {
        $post = Post::factory()->create();

        $response = $this->put('/posts/' . $post->id, [
            'title' => 'Updated Title',
            'content' => 'Updated content.',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('posts', ['title' => 'Updated Title']);
    }

    public function test_delete_post()
    {
        $post = Post::factory()->create();

        $response = $this->delete('/posts/' . $post->id);

        $response->assertStatus(302);
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
