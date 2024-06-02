<?php

namespace Leknoppix\YoutubeUpload\Services;

use Google\Service\Exception;
use Google_Client;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadAccessToken;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadChannel;

class TokenService
{
    public Google_Client $client;

    private string $youtube_client_id;

    private string $youtube_secret_id;

    public function __construct()
    {
        $this->youtube_client_id = is_string(config('youtubeupload.clientID')) ? config('youtubeupload.clientID') : '';
        $this->youtube_secret_id = is_string(config('youtubeupload.clientSecret')) ? config('youtubeupload.clientSecret') : '';
        $this->client = new Google_Client();
        $this->client->setClientId($this->youtube_client_id);
        $this->client->setClientSecret($this->youtube_secret_id);
    }

    /**
     * Refresh the access token of the specified channel id
     *
     * @throws Exception
     */
    public function refreshToken(YoutubeUploadChannel $channel): void
    {
        $accessTokenRecord = $channel->accesstokens()->first();
        if ($accessTokenRecord instanceof YoutubeUploadAccessToken) {
            $oldAccessToken = $accessTokenRecord->getAttribute('access_token');
            if (is_array($oldAccessToken) || is_string($oldAccessToken)) {
                $this->client->setAccessToken($oldAccessToken);
                if ($this->client->isAccessTokenExpired()) {
                    $refreshToken = $this->client->getRefreshToken();
                    if ($refreshToken) {
                        $newAccessToken = $this->client->fetchAccessTokenWithRefreshToken($refreshToken);
                        $channel->accesstokens()->update(['access_token' => $newAccessToken]);
                    } else {
                        throw new Exception('Refresh token not found.');
                    }
                }
            } else {
                throw new Exception('Access token is not in a valid format.');
            }
        } else {
            throw new Exception('Access token not found for the specified channel.');
        }
    }
}
