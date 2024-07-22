<?php

namespace Leknoppix\YoutubeUpload\Database\Seeders;

use Illuminate\Database\Seeder;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadAccessToken;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadChannel;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadVideo;

class YoutubeUploadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channels = YoutubeUploadChannel::factory()->count(10)->create();

        foreach ($channels as $channel) {
            // Creating 2 access tokens for each created Youtube channel
            YoutubeUploadAccessToken::factory()->count(2)->create(['channel_id' => $channel->getAttribute('id')]);

            // Creating 3 videos for each created Youtube channel
            YoutubeUploadVideo::factory()->count(20)->create(['channel_id' => $channel->getAttribute('id')]);
        }
    }
}
