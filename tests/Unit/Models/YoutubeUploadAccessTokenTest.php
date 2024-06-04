<?php

namespace Leknoppix\YoutubeUpload\Tests\Unit;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadAccessToken;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadChannel;
use Leknoppix\YoutubeUpload\Tests\TestCase;

class YoutubeUploadAccessTokenTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_a_youtube_upload_access_token()
    {
        $channel_id = $this->faker->uuid;
        $access_token = $this->faker->uuid;
        $accessTokenData = [
            'channel_id' => $channel_id,
            'access_token' => $access_token,
        ];

        $accessToken = YoutubeUploadAccessToken::create($accessTokenData);

        $this->assertInstanceOf(YoutubeUploadAccessToken::class, $accessToken);
        $this->assertDatabaseHas('youtubeupload_access_tokens', $accessTokenData);

        $channel_id2 = $this->faker->uuid;
        $access_token2 = $this->faker->uuid;
        $accessTokenData2 = [
            'channel_id' => $channel_id2,
            'access_token' => $access_token2,
        ];

        $accessToken2 = YoutubeUploadAccessToken::create($accessTokenData2);
        $this->assertDatabaseCount('youtubeupload_access_tokens', 2);

        $retrievedAccessToken = YoutubeUploadAccessToken::find($accessToken->id);
        $this->assertEquals($accessToken->id, $retrievedAccessToken->id);
        $this->assertEquals($channel_id, $retrievedAccessToken->channel_id);
    }

    /** @test */
    public function it_cannot_create_a_youtube_upload_access_token_without_access_token()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        $channel_id = $this->faker->uuid;
        $accessTokenData = [
            'channel_id' => $channel_id,
        ];

        $accessToken = YoutubeUploadAccessToken::create($accessTokenData);

        $this->assertDatabaseCount('youtubeupload_access_tokens', 0);
    }

    public function it_cannot_create_a_youtube_upload_access_token_without_channel_id()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        $access_token = $this->faker->uuid;
        $accessTokenData = [
            'access_token' => $access_token,
        ];

        $accessToken = YoutubeUploadAccessToken::create($accessTokenData);

        $this->assertDatabaseCount('youtubeupload_access_tokens', 0);
    }

    /** @test */
    public function it_has_a_youtube_upload_channel()
    {
        $channel = [
            'channel_name' => $this->faker->name,
            'channel_YT_id' => $this->faker->uuid,
            'is_favorite' => YoutubeUploadChannel::IS_FAVORITE_NO,
        ];
        $fakechannel = YoutubeUploadChannel::create($channel);

        $accessTokenData = [
            'channel_id' => $fakechannel->id,
            'access_token' => $this->faker->uuid,
        ];

        $accessToken = YoutubeUploadAccessToken::create($accessTokenData);

        $this->assertEquals($accessToken->channel->getAttribute('id'), $fakechannel->getAttribute('id'));
    }

    /** @test */
    public function it_can_update_the_access_token()
    {
        $accessTokenData = [
            'channel_id' => $this->faker->uuid,
            'access_token' => $this->faker->uuid,
        ];
        $accessToken = YoutubeUploadAccessToken::create($accessTokenData);

        $newAccessToken = $this->faker->uuid;

        $accessToken->access_token = $newAccessToken;
        $accessToken->save();

        // Refresh the instance from the database
        $accessToken->refresh();

        $this->assertEquals($newAccessToken, $accessToken->access_token);
    }

    /** @test */
    public function it_can_be_deleted()
    {
        $accessTokenData = [
            'channel_id' => $this->faker->uuid,
            'access_token' => $this->faker->uuid,
        ];
        $accessToken = YoutubeUploadAccessToken::create($accessTokenData);

        $accessToken->delete();

        // The accessor "exists" can be used to check if the model still exists in the database
        $this->assertFalse($accessToken->exists);
    }

    /** @test */
    public function it_formats_created_at_timestamp()
    {
        $accessTokenData = [
            'channel_id' => $this->faker->uuid,
            'access_token' => $this->faker->uuid,
        ];
        $accessToken = YoutubeUploadAccessToken::create($accessTokenData);

        // Utilisez directement Carbon::parse pour convertir la chaîne de date de la base de données en instance de Carbon
        $formattedCreatedAt = Carbon::parse($accessToken->fresh()->created_at)->format('d-m-Y H:i:s');

        $this->assertEquals($accessToken->created_at, $formattedCreatedAt);
    }

    /** @test */
    public function it_formats_updated_at_timestamp()
    {
        $accessTokenData = [
            'channel_id' => $this->faker->uuid,
            'access_token' => $this->faker->uuid,
        ];
        $accessToken = YoutubeUploadAccessToken::create($accessTokenData);

        // De même pour updated_at
        $formattedUpdatedAt = Carbon::parse($accessToken->fresh()->updated_at)->format('d-m-Y H:i:s');

        $this->assertEquals($accessToken->updated_at, $formattedUpdatedAt);
    }
}
