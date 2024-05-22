<?php

namespace Leknoppix\YoutubeUpload\Http\Controllers\Auth;

use Google\Service\Exception;
use Google\Service\YouTube\ChannelListResponse;
use Google_Service_YouTube;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadAccessToken as YUATAlias;

class YoutubeInfoController extends YoutubeConnexionController
{
    public function __construct()
    {
        parent::__construct();
        $this->youtubeclient = new Google_Service_YouTube($this->client);
    }

    /**
     * Get the information of the specified channel
     *
     * @throws \Google\Service\Exception
     */
    public function getInfoChannel(YUATAlias $channel): ChannelListResponse|Exception
    {
        $this->refreshToken($channel);
        $this->client->setAccessToken($channel->access_token);
        try {
            return $this->youtubeclient->channels->listChannels('snippet,statistics,contentDetails', [
                'id' => $channel->channel_id,
            ]);
        } catch (Exception $e) {
            return $e;
        }

    }
}
