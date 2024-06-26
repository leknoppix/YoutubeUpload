<?php

// config for Leknoppix/YoutubeUpload
return [
    'prefix' => env('YOUTUBEUPLOAD_PREFIX', 'admin'),
    'developer_key' => env('YOUTUBEUPLOAD_API_KEY'), // Clé publique développeur
    'clientID' => env('YOUTUBEUPLOAD_CLIENT_ID'),
    'clientSecret' => env('YOUTUBEUPLOAD_CLIENT_SECRET'),
    'callback' => env('YOUTUBEUPLOAD_CALLBACK', 'youtubeupload/callback'),
    'redirect' => env('YOUTUBEUPLOAD_REDIRECT'),
];
