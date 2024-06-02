<?php

namespace Leknoppix\YoutubeUpload\Http\Controllers;

use Google_Service_YouTube;
use Illuminate\Support\Collection;
use Leknoppix\YoutubeUpload\Http\Controllers\Auth\YoutubeConnexionController;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadChannel;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadVideo;

class YoutubeUploadVideoController extends YoutubeConnexionController
{
    public function __construct()
    {
        parent::__construct();
        $this->youtubeclient = new Google_Service_YouTube($this->client);
    }

    /**
     * Récupération des videos présentent dans la BDD
     *
     * @return Collection<array-key, YoutubeUploadVideo>
     */
    public function getVideoList(YoutubeUploadChannel $channel): Collection
    {
        return $channel->videos()->get();
    }
}
