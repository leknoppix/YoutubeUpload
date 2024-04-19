<?php

use Illuminate\Support\Facades\Route;

$prefix = config('youtubeupload.prefix');

Route::group(['namespace' => 'Admin', 'prefix' => $prefix], function () {
    //Url de connexion à youtube
    Route::get('/youtubeupload/index', function () {
        echo 'Route qui listera les chaînes ayant un token (actif ou pas)';
    });
    Route::get('/youtubeupload/add', function () {
        echo 'Route qui permettra de créer une chaine';
    });
    Route::get('/youtubeupload/edit/{id}', function () {
        echo 'Route qui permettra de modifier une chaine';
    });
    Route::get('/youtubeupload/delete/{id}', function () {
        echo 'Route qui permettra de supprimer une chaine';
    });
});
