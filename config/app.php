<?php

return [
    'providers' => [
        Leknoppix\YoutubeUpload\Providers\YoutubeUploadServiceProvider::class,
    ],
    'aliases' => [
        'YoutubeUpload' => Leknoppix\YoutubeUpload\Facades\YoutubeUpload::class,
    ],
];
