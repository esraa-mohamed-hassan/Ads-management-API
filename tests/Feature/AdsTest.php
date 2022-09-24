<?php

namespace Tests\Feature;

use App\Models\api\Ads;
use App\Models\api\Advertisers;
use App\Models\api\Categories;
use App\Models\api\Tags;
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


    public function test_create_ads()
    {
        $advertiser = Advertisers::orderby('created_at', 'desc')->first();
        $category = Categories::orderby('created_at', 'desc')->first();
        $tags = Tags::orderby('created_at', 'desc')->first();

        $payload = [
                    'title' => 'Adv title 1',
                    'description' => 'Adv description 1',
                    'advertiser' => $advertiser['id'],
                    'category' => $category['id'],
                    'start_date' => '2022-09-25',
                    'type' => 'free',
                    'tags' => $tags['id'],
        ];

        $response = $this->json('POST', '/api/ads', $payload)
            ->assertStatus(200);

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);

        $response->assertJson(
            [
                'success' => true,
                'message' => 'Added new Ads successfully.',
            ]
        );
    }

    public function test_get_ads_advertisers()
    {
        $advertiser = Advertisers::get();
        $email = $advertiser[0]['email'];
        $response = $this->json('GET', '/api/ads/advertiser/'.$email )
            ->assertStatus(200);

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);
        $response->assertJson(
            [
                'success' => true,
                'message' => "All Ads By Advertisers with email:" . $email . ".",
            ]
        );
    }

    public function test_filter_adsByTag()
    {
        $tags = Tags::orderby('created_at', 'desc')->first();
        $tag_id = $tags['id'];
        $payload = [];

        $response = $this->json('GET', '/api/ads/tags/' . $tag_id, $payload)
            ->assertStatus(200);

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);

        $response->assertJson(
            [
                'success' => true,
                'message' => 'All Ads Filtered by TagID:' . $tag_id . '.',
            ]
        );
    }

    public function test_filter_adsByCategory()
    {
        $ads = Ads::orderby('created_at', 'desc')->first();
        $category_id = $ads['category'];
        $response = $this->json('GET', '/api/ads/categories/' . $category_id)
            ->assertStatus(200);


        $response->assertJson(
            [
                'success' => true,
                'message' => 'All Ads Filtered by Category ID:' . $category_id . '.',
            ]
        );
    }
}
