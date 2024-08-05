<?php

namespace Leknoppix\YoutubeUpload\Services;

use Google\Service\Exception;
use Google\Service\YouTube\Video;
use Google_Client;
use Google_Service_YouTube;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadAccessToken;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadChannel;

class GetinfoService
{
    public string $youtube_client_id;

    public string $youtube_secret_id;

    public Google_Client $client;

    protected YoutubeUploadChannel $channel;

    private Google_Service_YouTube $youtube_client;

    public function __construct(YoutubeUploadChannel $channel)
    {
        $this->youtube_client_id = is_string(config('youtubeupload.clientID')) ? config('youtubeupload.clientID') : '';
        $this->youtube_secret_id = is_string(config('youtubeupload.clientSecret')) ? config('youtubeupload.clientSecret') : '';
        $client = new Google_Client;
        $client->setClientId($this->youtube_client_id);
        $client->setClientSecret($this->youtube_secret_id);
        $accessTokenRecord = $channel->accesstokens()->first();
        if ($accessTokenRecord instanceof YoutubeUploadAccessToken) {
            $accessTokenRecord = $accessTokenRecord->getAttribute('access_token');
            if (is_array($accessTokenRecord) || is_string($accessTokenRecord)) {
                $client->setAccessToken($accessTokenRecord);
            }
        }
        $this->youtube_client = new Google_Service_YouTube($client);
    }

    /**
     * @throws Exception
     */
    public function getInfo(string $VideoID): Video
    {

        $response = $this->youtube_client->videos->listVideos(['id', 'snippet', 'contentDetails'], [
            'id' => $VideoID,
        ]);

        if (count($response->getItems()) > 0) {
            $video = $response->getItems()[0];
            if ($video->getId() === $VideoID) {
                return $video;
            } else {
                throw new Exception('Video ID mismatch. Requested: '.$VideoID.', Found: '.$video->getId());
            }
        } else {
            throw new Exception('No video found with ID: '.$VideoID);
        }
    }
}
