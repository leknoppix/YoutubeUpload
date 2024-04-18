<?php

namespace Leknoppix\YoutubeUpload\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Leknoppix\YoutubeUpload
 */
class YoutubeUpload extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Leknoppix\YoutubeUpload\YoutubeUpload::class;
    }
}
