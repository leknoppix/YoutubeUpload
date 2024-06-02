<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadAccessToken;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadVideo;

class YoutubeUploadSeeder extends Seeder
{
    public function run(): void
    {
        YoutubeUploadAccessToken::factory(10)->create()->each(function ($token) {
            YoutubeUploadVideo::factory(3)->create([
                'channel_id' => $token->id,
                'user_id' => rand(1, 10),
            ]);
        });
    }
}
