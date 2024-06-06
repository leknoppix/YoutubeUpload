<?php

namespace Leknoppix\YoutubeUpload\Database\Seeders;

use Illuminate\Database\Seeder;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadChannel;

class YoutubeUploadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create channels
        $channels = YoutubeUploadChannel::factory()->count(10)->make();
        dd($channels);
    }
}
