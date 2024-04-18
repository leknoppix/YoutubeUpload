<?php

namespace Leknoppix\NewYoutube;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Leknoppix\NewYoutube\Commands\NewYoutubeCommand;

class NewYoutubeServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('newyoutube')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_newyoutube_table')
            ->hasCommand(NewYoutubeCommand::class);
    }
}
