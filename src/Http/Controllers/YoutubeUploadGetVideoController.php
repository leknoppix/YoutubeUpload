<?php

namespace Leknoppix\YoutubeUpload\Http\Controllers;

use Google\Service\Exception;
use Google_Client;
use Google_Service_YouTube;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadAccessToken;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadChannel;
use Leknoppix\YoutubeUpload\Services\GetinfoService;
use Leknoppix\YoutubeUpload\Services\TokenService;

class YoutubeUploadGetVideoController
{
    private string $youtube_client_id;

    private string $youtube_secret_id;

    private TokenService $tokenService;

    private GetinfoService $getinfoService;

    /**
     * @var array<int, array<string,int|string>>
     */
    private array $videos;

    public Google_Client $client;

    public Google_Service_YouTube $youtubeclient;

    public function __construct(TokenService $tokenService)
    {
        $this->youtube_client_id = is_string(config('youtubeupload.clientID')) ? config('youtubeupload.clientID') : '';
        $this->youtube_secret_id = is_string(config('youtubeupload.clientSecret')) ? config('youtubeupload.clientSecret') : '';
        $this->client = new Google_Client;
        $this->client->setClientId($this->youtube_client_id);
        $this->client->setClientSecret($this->youtube_secret_id);
        $this->tokenService = $tokenService;
    }

    /**
     * @throws Exception
     */
    public function getVideoOnlineOnYoutube(YoutubeUploadChannel $channel): void
    {
        $this->videos = [];
        $this->tokenService->refreshToken($channel);
        $accessTokenRecord = $channel->accesstokens()->first();
        if ($accessTokenRecord instanceof YoutubeUploadAccessToken) {
            $token = $accessTokenRecord->getAttribute('access_token');
        } else {
            throw new Exception('Access token not found for the specified channel.');
        }
        if (is_array($token) || is_string($token)) {
            $this->client->setAccessToken($token);
            $this->youtubeclient = new Google_Service_YouTube($this->client);
            $channelsResponse = $this->youtubeclient->channels->listChannels('contentDetails', [
                'mine' => true,
            ]);
            $uploadsPlaylistId = $channelsResponse->items[0]->contentDetails->relatedPlaylists->uploads;
            $pageToken = null;
            do {
                $playlistItemsResponse = $this->youtubeclient->playlistItems->listPlaylistItems('snippet', [
                    'playlistId' => $uploadsPlaylistId,
                    'maxResults' => 10,
                    'pageToken' => $pageToken,
                ]);
                foreach ($playlistItemsResponse->items as $item) {
                    $this->videos[] = $this->getInfoOnVideo($channel, $item->snippet->resourceId->videoId);
                }
                $pageToken = $playlistItemsResponse->nextPageToken;
            } while ($pageToken != null);
            $channel->videos()->upsert(
                $this->videos,
                ['videoId'],
                ['title', 'description', 'url', 'urlimage', 'duration', 'is_published', 'is_owner', 'videocategory_id'] // Colonnes à mettre à jour en cas de conflit
            );
        }
    }

    /**
     * Get info on a specified video
     *
     * @return array<string, int|string>
     *
     * @throws Exception
     */
    private function getInfoOnVideo(YoutubeUploadChannel $channel, string $videoId): array
    {
        $this->getinfoService = new GetinfoService($channel);
        $info = $this->getinfoService->getInfo($videoId);
        $snippet = $info->getSnippet();
        $details = $info->getContentDetails();

        return [
            'channel_id' => $channel->id,
            'title' => $snippet->getTitle(),
            'description' => $snippet->getDescription(),
            'videoId' => (string) $videoId,
            'url' => (string) 'https://www.youtube.com/watch?v='.$videoId,
            'urlimage' => (string) $snippet->getThumbnails()->getHigh()->getUrl(),
            'duration' => (string) $details->getDuration(),
            'is_published' => 1,
            'is_owner' => 1,
            'videocategory_id' => (int) $snippet->getCategoryId(),
        ];
    }
}
