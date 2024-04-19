<?php

namespace Leknoppix\YoutubeUpload;

use Leknoppix\YoutubeUpload\Commands\YoutubeUploadCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class YoutubeUploadServiceProvider extends PackageServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

    public function register()
    {
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'youtubeupload-migrations');
        $this->publishes([
            __DIR__.'/../config/youtubeupload.php' => config_path('youtubeupload.php'),
        ], 'youtubeupload-config');
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('youtubeupload')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_youtubeupload_table')
            ->hasCommand(YoutubeUploadCommand::class);
    }
}
