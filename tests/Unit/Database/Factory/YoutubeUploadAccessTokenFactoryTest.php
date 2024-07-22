<?php

namespace Leknoppix\YoutubeUpload\Tests\Unit\Database\Factory;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Leknoppix\YoutubeUpload\Database\Factories\YoutubeUploadAccessTokenFactory;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadAccessToken;
use Leknoppix\YoutubeUpload\Tests\TestCase;

class YoutubeUploadAccessTokenFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_access_token_factory()
    {
        $token = YoutubeUploadAccessToken::factory()->make();

        $this->assertNotNull($token->getAttribute('channel_id'));
        $this->assertNotEmpty($token->getAttribute('access_token'));
    }

    /** @test */
    public function it_can_produce_valid_definition_for_youtube_upload_access_token_model()
    {
        $youtubeAccessTokenFactory = new YoutubeUploadAccessTokenFactory();
        $definition = $youtubeAccessTokenFactory->definition();

        $this->assertArrayHasKey('channel_id', $definition);
        $this->assertArrayHasKey('access_token', $definition);
        $this->assertTrue(is_string($definition['access_token']));
    }
}
