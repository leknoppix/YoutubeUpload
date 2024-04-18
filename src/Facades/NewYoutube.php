<?php

namespace Leknoppix\NewYoutube\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Leknoppix\NewYoutube\NewYoutube
 */
class NewYoutube extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Leknoppix\NewYoutube\NewYoutube::class;
    }
}
