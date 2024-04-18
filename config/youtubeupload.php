<?php

// config for Leknoppix/YoutubeUpload
return [
    'youtube' => [
        'developer_key' => env('YOUTUBE_API_KEY'), // Clé publique développeur
        'clientID' => env('YOUTUBE_CLIENT_ID'),
        'clientSecret' => env('YOUTUBE_CLIENT_SECRET'),
        'redirect' => env('YOUTUBE_REDIRECT'),
    ]
];
