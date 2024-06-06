<?php

namespace Leknoppix\YoutubeUpload\Tests\Unit\Database\Factory;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Leknoppix\YoutubeUpload\Database\Factories\YoutubeUploadAccessTokenFactory;
use Leknoppix\YoutubeUpload\Tests\TestCase;

class YoutubeUploadAccessTokenFactoryTest extends TestCase
{
    use RefreshDatabase;

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
