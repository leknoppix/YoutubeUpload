<?php

namespace Leknoppix\YoutubeUpload\Tests\Unit\Facades;

use Leknoppix\YoutubeUpload\Facades\YoutubeUpload;
use Leknoppix\YoutubeUpload\Http\Controllers\YoutubeUploadAccessTokenController;
use Leknoppix\YoutubeUpload\Tests\TestCase;

class YoutubeUploadTest extends TestCase
{
    public function test_can_call_facade_method()
    {
        // Mock the YoutubeUploadAccessTokenController
        $mockController = \Mockery::mock(YoutubeUploadAccessTokenController::class);

        // Expect the generateToken method to be called once and return a specific value
        $mockController->shouldReceive('generateToken')->once()->andReturn('testToken');

        // Swap the instance in the service container
        $this->app->instance(YoutubeUploadAccessTokenController::class, $mockController);

        $token = YoutubeUpload::generateToken();

        $this->assertEquals('testToken', $token);
    }
}
