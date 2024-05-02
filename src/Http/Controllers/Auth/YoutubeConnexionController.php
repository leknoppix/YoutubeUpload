<?php

namespace Leknoppix\YoutubeUpload\Http\Controllers\Auth;

class YoutubeConnexionController
{
    private string $youtube_client_id;

    private string $youtube_secret_id;

    private string $callback;

    private array $scopes;

    public function __construct()
    {
        $this->youtube_client_id = is_string(config('youtubeupload.clientID')) ? config('youtubeupload.clientID') : '';
        $this->youtube_secret_id = is_string(config('youtubeupload.clientSecret')) ? config('youtubeupload.clientSecret') : '';
        $this->callback = config('app.url').'/'.config('youtubeupload.prefix').config('youtubeupload.callback');
        $this->scopes = ['https://www.googleapis.com/auth/youtube'];
    }

    public function connexion(): string
    {
        $client = new \Google_Client();
        $client->setClientId($this->youtube_client_id);
        $client->setClientSecret($this->youtube_secret_id);
        $client->setRedirectUri($this->callback);
        $client->setScopes($this->scopes);

        return $client->createAuthUrl();
    }
}
