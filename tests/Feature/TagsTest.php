<?php

namespace Tests\Feature;

use App\Models\api\Tags;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_tags()
    {
        $response = $this->json('GET', '/api/tags')
            ->assertStatus(200);

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);
        $response->assertJson(
            [
                'success' => true,
                'message' => 'All Tags.',
            ]
        );
    }

    public function test_create_tag()
    {
        $payload = [
            'name' => 'Test tag'
        ];

        $response = $this->json('POST', '/api/tags', $payload)
            ->assertStatus(200);

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);

        $response->assertJson(
            [
                'success' => true,
                'message' => 'Added new Tag successfully.',
            ]
        );
    }

    public function test_update_tag()
    {
        $payload = [
            'name' => 'Test update tag'
        ];
        $tags = Tags::orderby('created_at', 'desc')->first();
        $id = $tags['id'];

        $response = $this->json('PUT', '/api/tags/'.$id, $payload)
            ->assertStatus(200);

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);

        $response->assertJson(
            [
                'success' => true,
                'message' => 'Updated Tag successfully.',
            ]
        );
    }

    public function test_delete_tag()
    {
        $tags = Tags::orderby('created_at', 'asc')->first();;
        $id = $tags['id'];
        $response = $this->json('Delete', '/api/tags/'.$id)
            ->assertStatus(200);

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);

        $response->assertJson(
            [
                'success' => true,
                'message' => 'Deleted Tag successfully.',
            ]
        );
    }
}
