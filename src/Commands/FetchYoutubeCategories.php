<?php

namespace App\Console\Commands;

use Google_Client;
use Google_Service_YouTube;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class FetchYoutubeCategories extends Command
{
    protected $signature = 'youtubeupload:fetch-categories';

    protected $description = 'Fetch video categories from YouTube API and cache them';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $apiKey = config('youtubeupload.developer_key');
        $client = new Google_Client();
        if (is_string($apiKey)) {
            $client->setDeveloperKey($apiKey);
        }
        $youtube = new Google_Service_YouTube($client);
        $response = $youtube->videoCategories->listVideoCategories('snippet', ['regionCode' => 'FR']);
        $categories = $response->getItems();

        Cache::put('youtubeupload_video_categories', $categories, 86400);

        $this->info('YouTube video categories have been fetched and cached.');
    }
}
