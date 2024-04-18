<?php

namespace Leknoppix\NewYoutube;

use Leknoppix\NewYoutube\Commands\NewYoutubeCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
