<?php

namespace Leknoppix\YoutubeUpload\Http\Controllers\Auth;

class YoutubeConnexionController
{
    private $youtube_client_id;

    private $youtube_secret_id;

    private $callback;

    private $scopes;

    public function __construct()
    {
        $this->youtube_client_id = config(key: 'youtubeupload.clientID');
        $this->youtube_secret_id = config(key: 'youtubeupload.clientSecret');
        $this->callback = config('app.url').'/'.config('youtubeupload.prefix').config('youtubeupload.callback');
        $this->scopes = ['https://www.googleapis.com/auth/youtube'];
    }

    public function connexion()
    {
        $client = new \Google_Client();
        $client->setClientId($this->youtube_client_id);
        $client->setClientSecret($this->youtube_secret_id);
        $client->setRedirectUri($this->callback);
        $client->setScopes($this->scopes);

        return $client->createAuthUrl();
    }
}
