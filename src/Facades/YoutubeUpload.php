<?php

namespace Leknoppix\YoutubeUpload\Facades;

use Illuminate\Support\Facades\Facade;

class YoutubeUpload extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Leknoppix\YoutubeUpload\Http\Controllers\YoutubeController::class;
    }
}
