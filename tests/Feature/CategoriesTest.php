<?php

namespace Tests\Feature;

use App\Models\api\Categories;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_categories()
    {
        $response = $this->json('GET', '/api/categories')
            ->assertStatus(200);

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);
        $response->assertJson(
            [
                'success' => true,
                'message' => 'All Categories',
            ]
        );
    }

    public function test_create_category()
    {
        $payload = [
            'name' => 'Test tag'
        ];

        $response = $this->json('POST', '/api/categories', $payload)
            ->assertStatus(200);

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);

        $response->assertJson(
            [
                'success' => true,
                'message' => 'Added new category successfully.',
            ]
        );
    }

    public function test_update_category()
    {
        $categories = Categories::get();
        $id = $categories[0]->id;
        $payload = [
            'name' => 'Test update category'
        ];

        $response = $this->json('PUT', '/api/categories/'.$id, $payload)
            ->assertStatus(200);

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);

        $response->assertJson(
            [
                'success' => true,
                'message' => 'Updated category successfully.',
            ]
        );
    }

    public function test_delete_category()
    {
        $categories = Categories::get();
        $id = $categories[0]->id;
        $response = $this->json('Delete', '/api/categories/'.$id)
            ->assertStatus(200);

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);

        $response->assertJson(
            [
                'success' => true,
                'message' => 'Deleted category successfully.',
            ]
        );
    }
}
