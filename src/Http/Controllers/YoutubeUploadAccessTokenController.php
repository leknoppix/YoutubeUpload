<?php

namespace Leknoppix\YoutubeUpload\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Leknoppix\YoutubeUpload\Http\Controllers\Auth\YoutubeConnexionController;
use Leknoppix\YoutubeUpload\Http\Requests\YoutubeUploadAccessTokenRequest as YUATRAlias;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadAccessToken as YUATAlias;

class YoutubeUploadAccessTokenController
{
    private mixed $getcode;

    private string $code;

    public function index(): View
    {
        $channels = YUATAlias::orderBy('updated_at', 'desc')->get();
        /* création du lien pour ajouter une nouvelle chaine youtube */
        $link = new YoutubeConnexionController();
        $link = $link->connexion();

        return view('youtubeupload.index', compact('channels', 'link'));
    }

    public function callback(Request $request): RedirectResponse
    {
        $this->getcode = $request->input('code');
        assert(is_string($this->getcode));
        $this->code = $this->getcode;
        $ytc = new YoutubeConnexionController();
        $data = $ytc->getInformation($this->code);
        /* Création de la chaine dans la base de données */
        $channel = new YUATAlias(
            [
                'access_token' => json_encode($data['token']),
                'channel_name' => $data['channel-name'],
                'channel_id' => $data['channel-id'],
                'is_favorite' => YUATAlias::IS_FAVORITE_NO,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $channel->save();

        return redirect()->route('youtubeupload.edit', [$channel])
            ->with('status', 'create-youtube-channel-success');
    }

    public function edit(YUATAlias $channel): View
    {
        return view('youtubeupload.edit', ['channel' => $channel]);
    }

    public function update(YUATRAlias $request, YUATAlias $channel): RedirectResponse
    {
        // Put all 'is_favorite' to 'no' before update
        if ($channel->is_favorite == YUATAlias::IS_FAVORITE_YES) {
            YUATAlias::query()->update(['is_favorite' => YUATAlias::IS_FAVORITE_NO]);
        }
        // Save the new value
        $channel->update($request->all());

        return redirect()->route('youtubeupload.index')->with('status', 'update-youtube-channel-success');
    }

    /**
     * Delete the specified resource from database.
     */
    public function destroy(YUATAlias $channel): RedirectResponse
    {
        $result = $channel->delete();

        return redirect()->route('youtubeupload.index')->with('status', 'delete-youtube-channel-success');
    }
}
