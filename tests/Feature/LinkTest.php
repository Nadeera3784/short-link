<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Link;
use Illuminate\Foundation\Testing\WithFaker;

class LinkTest extends TestCase
{
    use RefreshDatabase, WithFaker;

     /**
     * Test if the link creation is successful.
     */
    public function test_create_link(): void
    {
        $requestData = [
            'url' => $this->faker->url()
        ];

        $response = $this->postJson('/api/v1/links', $requestData);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Link has been generated',
            ]);
    }

    /**
     * Test if the link already exists.
     */
    public function test_link_already_exists(): void
    {
        $existingUrl = $this->faker->url();

        Link::factory()->create([
            'url' => $existingUrl
        ]);

        $requestData = [
            'url' => $existingUrl
        ];

        $response = $this->postJson('/api/v1/links', $requestData);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Link already exists',
            ]);
    }

    /**
     * Test if an error occurs during link creation.
     */
    public function test_error_on_link_creation(): void
    {
        $requestData = [
            'url' => '',
        ];

        $response = $this->postJson('/api/v1/links', $requestData);

        $response->assertStatus(422)
            ->assertJson([
                'message' => 'The url field is required.'
            ]);
    }

    /**
     * Test if an error occurs during link with malicious url
     */
    public function test_error_on_link_with_malicious_url(): void
    {
        $requestData = [
            'url' => 'http://malware-driveby.test.safebrowsing.yandex',
        ];

        $response = $this->postJson('/api/v1/links', $requestData);

        $response->assertStatus(400)
            ->assertJson([
                'message' => 'An error occurred',
                'data' => [
                    'error' => "The provided URL is flagged for potential threats. For your safety, we advise against accessing this website."
                ]
            ]);
    }
}
