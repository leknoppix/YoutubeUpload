<?php

namespace Leknoppix\YoutubeUpload\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Leknoppix\YoutubeUpload\Http\Controllers\Auth\YoutubeConnexionController;
use Leknoppix\YoutubeUpload\Http\Requests\YoutubeUploadChannelRequest;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadChannel;

class YoutubeUploadChannelController
{
    /**
     * List all channels.
     */
    public function index(): View
    {
        $channels = YoutubeUploadChannel::orderBy('updated_at', 'desc')->get();
        $link = new YoutubeConnexionController;
        $link = $link->connexion();

        return view('youtubeupload.index', compact('channels', 'link'));
    }

    /**
     * Edit the specified resource from channel info.
     */
    public function edit(YoutubeUploadChannel $channel): View
    {
        return view('youtubeupload.edit', ['channel' => $channel]);
    }

    /**
     * Save the specified resource in database.
     */
    public function update(YoutubeUploadChannelRequest $request, YoutubeUploadChannel $channel): RedirectResponse
    {
        // Put all 'is_favorite' to 'no' before update
        if ($request->input('is_favorite') == YoutubeUploadChannel::IS_FAVORITE_YES) {
            YoutubeUploadChannel::query()->update(['is_favorite' => YoutubeUploadChannel::IS_FAVORITE_NO]);
        }
        // Save the new value
        sleep(1);
        $channel->update($request->all());

        return redirect()->route('youtubeupload.index')->with('status', 'update-youtube-channel-success');
    }

    /**
     * Delete the specified resource from database.
     */
    public function destroy(YoutubeUploadChannel $channel): RedirectResponse
    {
        $channel->delete();

        return redirect()->route('youtubeupload.index')->with('status', 'delete-youtube-channel-success');
    }

    /**
     * Get information from specified channel
     */
    public function info(YoutubeUploadChannel $channel): View
    {
        try {
            $ytc = app(YoutubeUploadInfoController::class);
            $channelDetails = $ytc->getInfoChannel($channel);
            // récupération des Vidéos de la chaine depuis la BDD
            $ytv = app(YoutubeUploadVideoController::class);
            $ytv->getVideoList($channel);

            return view('youtubeupload.info', ['channel' => $channel, 'channeldetails' => $channelDetails]);
        } catch (\Exception $e) {
            return view('youtubeupload.error', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Get information from specified channel
     */
    public function getVideoOnYoutube(YoutubeUploadChannel $channel): RedirectResponse
    {
        $ytv = app(YoutubeUploadGetVideoController::class);
        $ytv->getVideoOnlineOnYoutube($channel);

        return redirect()
            ->route('youtubeupload.info', $channel)
            ->with('status', 'create-youtube-get-online-success');
    }
}
