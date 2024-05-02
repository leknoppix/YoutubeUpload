<?php

namespace Leknoppix\YoutubeUpload;

use Illuminate\Support\Facades\View;
use Leknoppix\YoutubeUpload\Facades\YoutubeUpload;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class YoutubeUploadServiceProvider extends PackageServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        View::addNamespace('youtubeupload', __DIR__.'/../resources/views');
    }

    public function register()
    {
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'youtubeupload-migrations');
        $this->publishes([
            __DIR__.'/../config/youtubeupload.php' => config_path('youtubeupload.php'),
        ], 'youtubeupload-config');
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views'),
        ], 'youtubeupload-views');
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(YoutubeUpload::class);
        $this->app->alias(YoutubeUpload::class, 'youtubeupload');
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
            ->hasViews();
    }
}
