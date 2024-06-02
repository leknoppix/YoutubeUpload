<?php

namespace Leknoppix\YoutubeUpload\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Leknoppix\YoutubeUpload\Providers\YoutubeUploadServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Leknoppix\\YoutubeUpload\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            YoutubeUploadServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_newyoutube_table.php.stub';
        $migration->up();
        */
    }
}
