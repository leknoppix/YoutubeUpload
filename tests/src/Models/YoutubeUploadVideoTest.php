<?php

namespace Leknoppix\YoutubeUpload\Tests\Models;

use Leknoppix\YoutubeUpload\Models\YoutubeUploadAccessToken;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadVideo;

test('Le modèle Vidéo peut être instancie avec tous les champs complétés', function () {
    /* Création d'une fausse chaine */
    $youtubeUploadAccessToken = new YoutubeUploadAccessToken();
    $youtubeUploadAccessToken->channel_name = 'channel_name';
    $youtubeUploadAccessToken->channel_id = '1';
    $youtubeUploadAccessToken->access_token = 'access_token';

    /* Création d'une vidéo */
    $video = new YoutubeUploadVideo();
    $video->title = 'mon titre';
    $video->description = 'Description';
    $video->access_token_id = $youtubeUploadAccessToken->id;
    $video->videoId = '1212';
    $video->url = 'https://google.fr';
    $video->is_published = 1;
    $video->is_owner = 2;
    $video->videocategory_id = 3;
    $video->user_id = 4;
    $video->validation_id = 5;

    $this->assertInstanceOf(YoutubeUploadVideo::class, $video);
    $this->assertEquals('mon titre', $video->title);
    $this->assertEquals('Description', $video->description);
    $this->assertEquals($youtubeUploadAccessToken->id, $video->access_token_id);
    $this->assertEquals('1212', $video->videoId);
    $this->assertEquals('https://google.fr', $video->url);
    $this->assertEquals(1, $video->is_published);
    $this->assertEquals(2, $video->is_owner);
    $this->assertEquals(3, $video->videocategory_id);
    $this->assertEquals(4, $video->user_id);
    $this->assertEquals(5, $video->validation_id);
});


test('Le modèle Vidéo peut être instancie avec tous des champs null', function () {
    /* Création d'une fausse chaine */
    $youtubeUploadAccessToken = new YoutubeUploadAccessToken();
    $youtubeUploadAccessToken->channel_name = 'channel_name';
    $youtubeUploadAccessToken->channel_id = '1';
    $youtubeUploadAccessToken->access_token = 'access_token';

    /* Création d'une vidéo */
    $video = new YoutubeUploadVideo();
    $video->title = 'mon titre';
    $video->description = null;
    $video->access_token_id = $youtubeUploadAccessToken->id;
    $video->videoId = '1212';
    $video->url = 'https://google.fr';
    $video->is_published = 1;
    $video->is_owner = 2;
    $video->videocategory_id = null;
    $video->user_id = 4;
    $video->validation_id = 5;

    $this->assertInstanceOf(YoutubeUploadVideo::class, $video);
    $this->assertEquals('mon titre', $video->title);
    $this->assertNull($video->description);
    $this->assertEquals($youtubeUploadAccessToken->id, $video->access_token_id);
    $this->assertEquals('1212', $video->videoId);
    $this->assertEquals('https://google.fr', $video->url);
    $this->assertEquals(1, $video->is_published);
    $this->assertEquals(2, $video->is_owner);
    $this->assertNull($video->videocategory_id);
    $this->assertEquals(4, $video->user_id);
    $this->assertEquals(5, $video->validation_id);

});
