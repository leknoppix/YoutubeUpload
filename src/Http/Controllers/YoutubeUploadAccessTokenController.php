<?php

namespace Leknoppix\YoutubeUpload\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Leknoppix\YoutubeUpload\Http\Controllers\Auth\YoutubeConnexionController;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadAccessToken;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadChannel;

class YoutubeUploadAccessTokenController
{
    private mixed $getcode;

    private string $code;

    /**
     * Save de token in database.
     */
    public function callback(Request $request): RedirectResponse
    {
        $this->getcode = $request->input('code');
        assert(is_string($this->getcode));
        $this->code = $this->getcode;
        $ytc = app(YoutubeConnexionController::class);
        $data = $ytc->getInformation($this->code);
        /* Création de la chaine dans la base de données */
        $channel = new YoutubeUploadChannel(
            [
                'channel_name' => $data['channel-name'],
                'channel_YT_id' => $data['channel-id'],
                'is_favorite' => YoutubeUploadChannel::IS_FAVORITE_NO,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $channel->save();
        $accessToken = new YoutubeUploadAccessToken(
            [
                'channel_id' => $channel->id,
                'access_token' => json_encode($data['token']),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $accessToken->save();

        return redirect()
            ->route('youtubeupload.edit', [$channel])
            ->with('status', 'create-youtube-channel-success');
    }
}
