<?php

namespace Leknoppix\YoutubeUpload\Tests\Unit\Database\Seeders;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Leknoppix\YoutubeUpload\Database\Seeders\YoutubeUploadSeeder;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadAccessToken;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadChannel;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadVideo;
use Leknoppix\YoutubeUpload\Tests\TestCase;

class YoutubeUploadSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_seed_data_generation()
    {
        $seeder = new YoutubeUploadSeeder();
        $seeder->run();

        $this->assertEquals(10, YoutubeUploadChannel::count());
        $this->assertEquals(20, YoutubeUploadAccessToken::count());
        $this->assertEquals(200, YoutubeUploadVideo::count());
    }
}
