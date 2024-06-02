<?php

namespace Leknoppix\YoutubeUpload\Http\Controllers;

use Google\Service\Exception;
use Google\Service\YouTube\ChannelListResponse;
use Google_Service_YouTube;
use Leknoppix\YoutubeUpload\Http\Controllers\Auth\YoutubeConnexionController;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadAccessToken;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadChannel;
use Leknoppix\YoutubeUpload\Services\TokenService;

class YoutubeUploadInfoController extends YoutubeConnexionController
{
    protected TokenService $tokenService;

    public function __construct(TokenService $tokenService)
    {
        parent::__construct();
        $this->tokenService = $tokenService;
        $this->youtubeclient = new Google_Service_YouTube($this->client);
    }

    /**
     * Get the information of the specified channel
     *
     * @throws Exception
     */
    public function getInfoChannel(YoutubeUploadChannel $channel): ChannelListResponse
    {
        $this->tokenService->refreshToken($channel);
        $accessToken = $channel->accesstokens()->first();
        if ($accessToken instanceof YoutubeUploadAccessToken) {
            $accessTokenValue = $accessToken->getAttribute('access_token');
            if (is_array($accessTokenValue) || is_string($accessTokenValue)) {
                $this->client->setAccessToken($accessTokenValue);
            } else {
                throw new Exception('Access token is not in a valid format.');
            }
        } else {
            throw new Exception('Access token not found for the specified channel.');
        }
        try {
            return $this->youtubeclient->channels->listChannels('snippet,statistics,contentDetails', [
                'id' => $channel->getAttribute('channel_YT_id'),
            ]);
        } catch (\Google\Service\Exception $e) {
            throw new Exception('Error fetching channel information: '.$e->getMessage(), 0, $e);
        }
    }
}
