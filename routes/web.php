<?php

use Illuminate\Support\Facades\Route;
use Leknoppix\YoutubeUpload\Http\Controllers\YoutubeUploadAccessTokenController;
use Leknoppix\YoutubeUpload\Http\Controllers\YoutubeUploadChannelController;

$prefix = config('youtubeupload.prefix');

Route::prefix($prefix)->middleware(['web'])->group(function () {
    Route::resource('youtubeupload', YoutubeUploadChannelController::class)
        ->except('show', 'create', 'store', 'add')
        ->parameters(['youtubeupload' => 'channel']);
    Route::get('youtubeupload/callback', [YoutubeUploadAccessTokenController::class, 'callback'])
        ->name('youtubeupload.callback');
    Route::get('youtubeupload/{channel}/info/', [YoutubeUploadChannelController::class, 'info'])
        ->name('youtubeupload.info');
    Route::get('youtubeupload/{channel}/get-video-on-youtube', [YoutubeUploadChannelController::class, 'getVideoOnYoutube'])
        ->name('youtubeupload.getvideoonyoutube');
});
