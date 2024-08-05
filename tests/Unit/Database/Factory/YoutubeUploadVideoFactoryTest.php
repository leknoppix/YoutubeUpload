<?php

namespace Leknoppix\YoutubeUpload\Tests\Unit\Database\Factory;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Leknoppix\YoutubeUpload\Database\Factories\YoutubeUploadVideoFactory;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadVideo;
use Leknoppix\YoutubeUpload\Tests\TestCase;

class YoutubeUploadVideoFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_video_factory()
    {
        $video = YoutubeUploadVideo::factory()->make();

        $this->assertNotNull($video->getAttribute('channel_id'));
        $this->assertNotEmpty($video->getAttribute('title'));
        $this->assertNotEmpty($video->getAttribute('description'));
        $this->assertNotEmpty($video->getAttribute('videoId'));
    }

    public function testDefinitionMethod(): void
    {

        $factory = new YoutubeUploadVideoFactory;

        $definition = $factory->definition();

        self::assertArrayHasKey('channel_id', $definition);
        self::assertArrayHasKey('title', $definition);
        self::assertArrayHasKey('description', $definition);
        self::assertArrayHasKey('videoId', $definition);
        self::assertArrayHasKey('url', $definition);
        self::assertArrayHasKey('urlimage', $definition);
        self::assertArrayHasKey('duration', $definition);
        self::assertArrayHasKey('is_published', $definition);
        self::assertArrayHasKey('is_owner', $definition);
        self::assertArrayHasKey('videocategory_id', $definition);
        self::assertArrayHasKey('user_id', $definition);
    }
}
