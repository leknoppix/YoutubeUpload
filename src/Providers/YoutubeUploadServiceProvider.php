<?php

namespace Leknoppix\YoutubeUpload\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\View;
use Leknoppix\YoutubeUpload\Facades\YoutubeUpload;
use Leknoppix\YoutubeUpload\Services\TokenService;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class YoutubeUploadServiceProvider extends PackageServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        View::addNamespace('youtubeupload', __DIR__.'/../../resources/views');
    }

    protected function registerFactories(): void
    {
        Factory::useNamespace('\Leknoppix\YoutubeUpload\Database\Factories');
    }

    public function register(): void
    {
        $this->app->singleton(TokenService::class, function ($app) {
            return new TokenService();
        });
        $this->publishes([
            __DIR__.'/../Commands' => base_path('app/Console/Commands'),
        ], 'youtubeupload-commands');
        $this->publishes([
            __DIR__.'/../Database/Migrations' => database_path('migrations'),
            __DIR__.'/../Database/Factories' => database_path('factories'),
            __DIR__.'/../Database/Seeders' => database_path('seeders'),
        ], 'youtubeupload-migrations');
        $this->publishes([
            __DIR__.'/../../config/youtubeupload.php' => config_path('youtubeupload.php'),
        ], 'youtubeupload-config');
        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views'),
            __DIR__.'/../../resources/js' => resource_path('js'),
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
