<?php

namespace Leknoppix\YoutubeUpload\Tests\Unit\Factories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadAccessToken;
use Leknoppix\YoutubeUpload\Tests\TestCase;

class YoutubeUploadChannelFactoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testYoutubeUploadAccessTokenFactoryCreatesValidYoutubeUploadAccessToken()
    {
        $channel_id = $this->faker->uuid;
        $access_token = $this->faker->uuid;
        $accessTokenData = [
            'channel_id' => $channel_id,
            'access_token' => $access_token,
        ];
        // Crée un access token à l'aide de la factory
        $youtubeUploadAccessToken = YoutubeUploadAccessToken::create($accessTokenData);

        // Vérifie que l'access token possède le bon modèle
        $this->assertInstanceOf(YoutubeUploadAccessToken::class, $youtubeUploadAccessToken);

        // Vérifie que l'access token possède un channel_id
        $this->assertNotNull($youtubeUploadAccessToken->getAttribute('channel_id'));

        // Vérifie que l'access token possède un access_token
        $this->assertNotNull($youtubeUploadAccessToken->getAttribute('access_token'));
    }
}
