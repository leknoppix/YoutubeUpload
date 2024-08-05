<?php

namespace Leknoppix\YoutubeUpload\Database;

use Illuminate\Database\Eloquent\Factories\Factory;

class FactoryWrapper
{
    /**
     * @var string|null
     */
    protected static $namespace;

    public static function useNamespace(string $namespace): void
    {
        self::$namespace = $namespace;
        Factory::guessFactoryNamesUsing(
            /**
             * @param  class-string<Illuminate\Database\Eloquent\Model>  $modelName
             * @return class-string<Illuminate\Database\Eloquent\Factories\Factory>
             */
            function (string $modelName): string {
                $fqnFactoryName = self::getFullyQualifiedFactoryName($modelName);

                if (! class_exists($fqnFactoryName)) {
                    throw new \RuntimeException('The factory '.$fqnFactoryName.' does not exist');
                }

                return $fqnFactoryName;
            }
        );
    }

    public static function getNamespace(): ?string
    {
        return self::$namespace;
    }

    private static function getFullyQualifiedFactoryName(string $modelName): string
    {
        $factoryName = class_basename($modelName).'Factory';

        if (self::$namespace) {
            return self::$namespace.'\\'.$factoryName;
        }

        // Default to just the model name with 'Factory'
        return $modelName.'Factory';
    }
}
