<?php

use Illuminate\Support\Facades\Route;
use Leknoppix\YoutubeUpload\Http\Controllers\YoutubeUploadAccessTokenController;

$prefix = config('youtubeupload.prefix');

Route::prefix($prefix)->middleware(['web'])->group(function () {
    Route::resource('youtubeupload', YoutubeUploadAccessTokenController::class)
        ->except('show', 'create', 'store', 'add')
        ->parameters(['youtubeupload' => 'channel']);
    Route::get('youtubeupload/callback', [YoutubeUploadAccessTokenController::class, 'callback'])
        ->name('youtubeupload.callback');
    Route::get('youtubeupload/{channel}/info/', [YoutubeUploadAccessTokenController::class, 'info'])
        ->name('youtubeupload.info');
});
