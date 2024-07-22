<?php

namespace Leknoppix\YoutubeUpload\Database;

use Illuminate\Database\Eloquent\Factories\Factory;

class FactoryWrapper
{
    /**
     * @var string|null
     */
    protected static $namespace;

    public static function useNamespace($namespace): void
    {
        self::$namespace = $namespace;
        Factory::guessFactoryNamesUsing(function (string $modelName) use ($namespace) {
            return $namespace.'\\'.$modelName.'Factory';
        });
    }

    public static function getNamespace(): ?string
    {
        return self::$namespace;
    }
}
