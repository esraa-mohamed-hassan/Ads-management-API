<?php

namespace Tests\Feature;

use App\Models\api\Advertisers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class AdvertisersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_advertisers()
    {
        $response = $this->json('GET', '/api/advertisers')
            ->assertStatus(200);

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);
        $response->assertJson(
            [
                'success' => true,
                'message' => 'All Advertisers.',
            ]
        );
    }

    public function test_create_advertiser()
    {
        $payload = [
            'name' => Str::random(8),
            'email' => 'advertiser_' . substr(str_shuffle("0123456789"), 0, 3) . '@adsmail.com',
        ];

        $response = $this->json('POST', '/api/advertisers', $payload)
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

    public function test_update_advertiser()
    {
        $advertisers = Advertisers::get();
        $id = $advertisers[0]->id;
        $payload = [
            'name' => Str::random(8),
            'email' => 'advertiser_' . substr(str_shuffle("0123456789"), 0, 3) . '@adsmail.com',
        ];

        $response = $this->json('PUT', '/api/advertisers/' . $id, $payload)
            ->assertStatus(200);

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);

        $response->assertJson(
            [
                'success' => true,
                'message' => 'Updated advertiser successfully.',
            ]
        );
    }

    public function test_delete_advertiser()
    {
        $advertisers = Advertisers::get();
        $id = $advertisers[0]->id;
        $response = $this->json('Delete', '/api/advertisers/' . $id)
            ->assertStatus(200);


        $response->assertJson(
            [
                'success' => true,
                'message' => 'Deleted advertiser successfully',
            ]
        );
    }
}
