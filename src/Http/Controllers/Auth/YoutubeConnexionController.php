<?php

namespace Leknoppix\YoutubeUpload\Http\Controllers\Auth;

use Google_Client;
use Google_Service_YouTube;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadAccessToken as YUATAlias;

class YoutubeConnexionController
{
    private string $youtube_client_id;

    private string $youtube_secret_id;

    private string $callback;

    /**
     * @var array<int, string>
     */
    private array $scopes;

    public Google_Client $client;

    public Google_Service_YouTube $youtubeclient;

    public function __construct()
    {
        $this->youtube_client_id = is_string(config('youtubeupload.clientID')) ? config('youtubeupload.clientID') : '';
        $this->youtube_secret_id = is_string(config('youtubeupload.clientSecret')) ? config('youtubeupload.clientSecret') : '';
        $this->callback = config('app.url').'/'.config('youtubeupload.prefix').config('youtubeupload.callback');
        $this->scopes = ['https://www.googleapis.com/auth/youtube'];
        $this->client = new Google_Client();
        $this->client->setClientId($this->youtube_client_id);
        $this->client->setClientSecret($this->youtube_secret_id);
        $this->client->setRedirectUri($this->callback);
        $this->client->setScopes($this->scopes);
        $this->client->setAccessType('offline');
        // $this->client->setApprovalPrompt('force');
        $this->client->setPrompt('consent');
        $this->youtubeclient = new Google_Service_YouTube($this->client);
    }

    public function connexion(): string
    {
        return $this->client->createAuthUrl();
    }

    /**
     * @return array<string, int|string>
     *
     * @throws \Google\Service\Exception
     */
    public function getInformation(string $code): array
    {
        $data = [];
        $token = $this->getToken($code);
        $info = $this->youtubeclient->channels->listChannels('snippet', ['mine' => true]);
        $data['channel-id'] = $info[0]['id'];
        $data['channel-name'] = $info[0]['snippet']['title'];
        $data['token'] = $token;

        return $data;
    }

    /**
     * @return array<string, int|string>|null
     *
     * @throws \Google\Service\Exception
     */
    public function getToken(string $code): ?array
    {
        /* old method depreciated */
        // $this->client->authenticate($code);
        $this->client->fetchAccessTokenWithAuthCode($code);

        return $this->client->getAccessToken();
    }

    /**
     * Refresh the access token of the specified channel id
     */
    public function refreshToken(YUATAlias $channel): void
    {
        $this->client->setAccessToken($channel->access_token);
        if ($this->client->isAccessTokenExpired()) {
            $refreshToken = $this->client->getRefreshToken();
            $accessToken = $this->client->fetchAccessTokenWithRefreshToken($refreshToken);
            $channel->update(['access_token' => $accessToken]);
        }
    }
}
