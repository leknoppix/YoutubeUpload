<?php

use Illuminate\Support\Facades\Route;
use Leknoppix\YoutubeUpload\Http\Controllers\YoutubeController;

$prefix = config('youtubeupload.prefix');

Route::group(['namespace' => 'Admin', 'prefix' => $prefix], function () {
    //Url de connexion à youtube
    Route::get('/youtubeupload/index', [YoutubeController::class, 'index'])->name('youtubeupload.index');
    Route::get('/youtubeupload/callback', [YoutubeController::class, 'callback'])->name('youtubeupload.callback');
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
