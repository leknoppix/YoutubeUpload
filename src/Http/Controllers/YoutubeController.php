<?php

namespace Leknoppix\YoutubeUpload\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Leknoppix\YoutubeUpload\Http\Controllers\Auth\YoutubeConnexionController;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadAccessToken;

class YoutubeController
{
    public function index(): View
    {
        $channels = YoutubeUploadAccessToken::get();
        $link = new YoutubeConnexionController();
        $link = $link->connexion();

        return view('youtubeupload.auth.youtubelogin', ['channels' => $channels, 'link' => $link]);
    }

    public function callback(Request $resquest)
    {
        //récupération du code d'authentification et création du formulaire d'enregistrement dans la bdd
        dd($resquest->input());
    }
}
