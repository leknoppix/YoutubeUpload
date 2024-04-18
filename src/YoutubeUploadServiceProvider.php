<?php

namespace Leknoppix\YoutubeUpload;

use Leknoppix\YoutubeUpload\Commands\YoutubeUploadCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class YoutubeUploadServiceProvider extends PackageServiceProvider
{
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
