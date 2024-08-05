<?php

namespace Leknoppix\YoutubeUpload\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadChannel;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadVideo;
use Leknoppix\YoutubeUpload\Tests\TestCase;

class YoutubeUploadVideoTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_has_a_channel_relationship()
    {
        $channel = [
            'channel_name' => $this->faker->name,
            'channel_YT_id' => $this->faker->uuid,
            'is_favorite' => YoutubeUploadChannel::IS_FAVORITE_NO,
        ];
        $channel = YoutubeUploadChannel::create($channel);

        $fakevideo = [
            'channel_id' => $channel->getAttribute('id'),
            'title' => $this->faker->name,
            'description' => $this->faker->text,
            'videoId' => $this->faker->uuid,
            'url' => $this->faker->url,
            'urlimage' => $this->faker->imageUrl,
            'duration' => $this->faker->time,
            'is_published' => $this->faker->boolean,
            'is_owner' => $this->faker->boolean,
            'videocategory_id' => $this->faker->randomNumber(),
        ];
        $video = YoutubeUploadVideo::create($fakevideo);

        //$this->assertInstanceOf(YoutubeUploadChannel::class, $video->channel);
        $this->assertEquals($channel->getAttribute('id'), $video->channel->getAttribute('id'));
    }

    /** @test */
    public function it_has_fillable_properties()
    {
        $fillable = [
            'channel_id',
            'title',
            'description',
            'videoId',
            'url',
            'urlimage',
            'duration',
            'is_published',
            'is_owner',
            'videocategory_id',
            'user_id',
        ];

        $video = new YoutubeUploadVideo;

        $this->assertEquals($fillable, $video->getFillable());
    }

    /** @test */
    public function it_can_be_created_with_valid_data()
    {
        $videoData = [
            'channel_id' => 1,
            'title' => 'Test Video',
            'description' => 'This is a test video description',
            'videoId' => '123abc',
            'url' => 'http://test.com/video',
            'urlimage' => 'http://test.com/image.jpg',
            'duration' => 120,
            'is_published' => true,
            'is_owner' => false,
            'videocategory_id' => 1,
            'user_id' => 1,
        ];

        $video = YoutubeUploadVideo::create($videoData);

        $this->assertInstanceOf(YoutubeUploadVideo::class, $video);
        $this->assertEquals('Test Video', $video->title);
        $this->assertEquals('This is a test video description', $video->description);
    }
}
