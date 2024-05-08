<?php

namespace Leknoppix\YoutubeUpload\Tests\Models;

use Leknoppix\YoutubeUpload\Models\YoutubeUploadAccessToken;

test('Le modèle Access Token peut être instancie', function () {

    $youtubeUploadAccessToken = new YoutubeUploadAccessToken();
    $youtubeUploadAccessToken->channel_name = 'channel_name';
    $youtubeUploadAccessToken->channel_id = '1';
    $youtubeUploadAccessToken->access_token = 'access_token';

    $this->assertInstanceOf(YoutubeUploadAccessToken::class, $youtubeUploadAccessToken);
    $this->assertEquals('channel_name', $youtubeUploadAccessToken->channel_name);
    $this->assertEquals('1', $youtubeUploadAccessToken->channel_id);
    $this->assertEquals('access_token', $youtubeUploadAccessToken->access_token);
});

test('Le modèle Access Token peut être instancie avec 2 chaines', function () {
    $youtubeUploadAccessToken = new YoutubeUploadAccessToken();
    $youtubeUploadAccessToken->channel_name = 'channel_name';
    $youtubeUploadAccessToken->channel_id = 'uuid';
    $youtubeUploadAccessToken->access_token = 'access_token';

    $youtubeUploadAccessToken2 = new YoutubeUploadAccessToken();
    $youtubeUploadAccessToken2->channel_name = 'channel_name_2';
    $youtubeUploadAccessToken2->channel_id = 'uuid_2';
    $youtubeUploadAccessToken2->access_token = 'access_token-2';

    $this->assertInstanceOf(YoutubeUploadAccessToken::class, $youtubeUploadAccessToken);
    $this->assertEquals('channel_name', $youtubeUploadAccessToken->channel_name);
    $this->assertEquals('uuid', $youtubeUploadAccessToken->channel_id);
    $this->assertEquals('access_token', $youtubeUploadAccessToken->access_token);

    $this->assertInstanceOf(YoutubeUploadAccessToken::class, $youtubeUploadAccessToken2);
    $this->assertEquals('channel_name_2', $youtubeUploadAccessToken2->channel_name);
    $this->assertEquals('uuid_2', $youtubeUploadAccessToken2->channel_id);
    $this->assertEquals('access_token-2', $youtubeUploadAccessToken2->access_token);
});
