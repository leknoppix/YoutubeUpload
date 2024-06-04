<?php

namespace Leknoppix\YoutubeUpload\Tests\Unit;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadAccessToken;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadChannel;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadVideo;
use Leknoppix\YoutubeUpload\Tests\TestCase;

class YoutubeUploadChannelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_initializes_with_correct_attributes()
    {
        $channel = new YoutubeUploadChannel([
            'channel_YT_id' => 'UC1234567890',
            'channel_name' => 'My Channel',
            'is_favorite' => YoutubeUploadChannel::IS_FAVORITE_YES,
        ]);

        $this->assertEquals('UC1234567890', $channel->channel_YT_id);
        $this->assertEquals('My Channel', $channel->channel_name);
        $this->assertEquals(YoutubeUploadChannel::IS_FAVORITE_YES, $channel->is_favorite);
    }

    /** @test */
    public function it_has_correct_constants()
    {
        $this->assertEquals('yes', YoutubeUploadChannel::IS_FAVORITE_YES);
        $this->assertEquals('no', YoutubeUploadChannel::IS_FAVORITE_NO);
    }

    /** @test */
    public function it_has_a_access_token_relation()
    {
        $channel = [
            'channel_name' => $this->faker->name,
            'channel_YT_id' => $this->faker->uuid,
            'is_favorite' => YoutubeUploadChannel::IS_FAVORITE_NO,
        ];
        $channel = YoutubeUploadChannel::create($channel);
        $token = YoutubeUploadAccessToken::create([
            'channel_id' => $channel->id,
            'access_token' => $this->faker->uuid,
        ]);

        $this->assertEquals($token->getAttribute('id'), $channel->accessTokens->getAttribute('id'));
    }

    /** @test */
    public function it_has_a_video_relation()
    {
        $channel = [
            'channel_name' => $this->faker->name,
            'channel_YT_id' => $this->faker->uuid,
            'is_favorite' => YoutubeUploadChannel::IS_FAVORITE_NO,
        ];
        $channel = YoutubeUploadChannel::create($channel);
        $video = YoutubeUploadVideo::create([
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
        ]);

        $this->assertEquals($video->getAttribute('id'), $channel->videos->first()->getAttribute('id'));
    }

    /** @test */
    public function it_has_correctly_formatted_timestamps()
    {
        $channel = [
            'channel_name' => $this->faker->name,
            'channel_YT_id' => $this->faker->uuid,
            'is_favorite' => YoutubeUploadChannel::IS_FAVORITE_NO,
        ];
        $channel = YoutubeUploadChannel::create($channel);

        $this->assertEquals($channel->created_at, Carbon::parse($channel->getRawOriginal('created_at'))->format('d-m-Y H:i:s'));
        $this->assertEquals($channel->updated_at, Carbon::parse($channel->getRawOriginal('updated_at'))->format('d-m-Y H:i:s'));
    }

    /** @test */
    public function it_deletes_related_videos_and_tokens_on_deletion()
    {
        $channel = [
            'channel_name' => $this->faker->name,
            'channel_YT_id' => $this->faker->uuid,
            'is_favorite' => YoutubeUploadChannel::IS_FAVORITE_NO,
        ];
        $channel = YoutubeUploadChannel::create($channel);
        $this->assertDatabaseCount('youtubeupload_channel', 1);
        $video = YoutubeUploadVideo::create([
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
        ]);
        $video = YoutubeUploadVideo::create([
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
        ]);
        $this->assertDatabaseCount('youtubeupload_videos', 2);
        $token = YoutubeUploadAccessToken::create([
            'channel_id' => $channel->getAttribute('id'),
            'access_token' => $this->faker->uuid,
        ]);
        $this->assertDatabaseCount('youtubeupload_access_tokens', 1);

        $channel->delete();

        $this->assertDatabaseCount('youtubeupload_videos', 0);
        $this->assertDatabaseCount('youtubeupload_access_tokens', 0);
        $this->assertDatabaseCount('youtubeupload_videos', 0);
    }
}
