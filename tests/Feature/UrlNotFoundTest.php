<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlNotFoundTest extends TestCase
{
    /** @test */
    public function it_returns_404_for_nonexistent_url()
    {
        // Attempt to access a URL that should not exist
        $response = $this->get('/nonexistent-url');

        // Assert that the response status code is 404
        $response->assertStatus(404);
    }
}
