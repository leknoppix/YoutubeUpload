<?php

use Illuminate\Support\Facades\Route;

$prefix = config('youtubeupload.prefix');

Route::group(['namespace' => 'Admin', 'prefix' => $prefix], function () {
    //Url de connexion à youtube
    Route::get('/youtubeupload/index', function () {
        echo 'OK';
    });
    //Url de retour

    //Enregistrement du Token
});
