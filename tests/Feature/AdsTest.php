<?php

namespace Tests\Feature;

use App\Models\api\Ads;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_ads()
    {
        $response = $this->json('GET', '/api/ads')
            ->assertStatus(200);

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);
        $response->assertJson(
            [
                'success' => true,
                'message' => 'All Ads.',
            ]
        );
    }

    public function test_create_ads()
    {
        $payload = [];

        $response = $this->json('POST', '/api/ads', $payload)
            ->assertStatus(200);

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);

        $response->assertJson(
            [
                'success' => true,
                'message' => 'Added new advertiser successfully.',
            ]
        );
    }

    public function test_update_ads()
    {
        $advertisers = Ads::get();
        $id = $advertisers[0]->id;
        $payload = [];

        $response = $this->json('PUT', '/api/ads/' . $id, $payload)
            ->assertStatus(200);

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);

        $response->assertJson(
            [
                'success' => true,
                'message' => 'Updated ads successfully.',
            ]
        );
    }

    public function test_delete_ads()
    {
        $ads = Ads::get();
        $id = $ads[0]->id;
        $response = $this->json('Delete', '/api/ads/' . $id)
            ->assertStatus(200);


        $response->assertJson(
            [
                'success' => true,
                'message' => 'Deleted ads successfully',
            ]
        );
    }
}
