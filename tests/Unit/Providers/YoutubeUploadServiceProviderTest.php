<?php

namespace Leknoppix\YoutubeUpload\Tests\Unit\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\View;
use Leknoppix\YoutubeUpload\Database\FactoryWrapper;
use Leknoppix\YoutubeUpload\Facades\YoutubeUpload;
use Leknoppix\YoutubeUpload\Providers\YoutubeUploadServiceProvider;
use Leknoppix\YoutubeUpload\Services\TokenService;
use Leknoppix\YoutubeUpload\Tests\TestCase;
use ReflectionMethod;
use Spatie\LaravelPackageTools\Package;

abstract class FakeFactory extends Factory
{
    public static $namespace;

    public static function useNamespace($namespace)
    {
        self::$namespace = $namespace;
    }

    public static function getNamespace()
    {
        return self::$namespace;
    }
}

class YoutubeUploadServiceProviderTest extends TestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app)
    {
        return [YoutubeUploadServiceProvider::class];
    }

    protected function tearDown(): void
    {
        \Mockery::close();
        parent::tearDown();
    }

    public function testBootMethod()
    {
        // Verify that routes are loaded
        $this->assertNotEmpty($this->app['router']->getRoutes());

        // Verify that migrations are loaded
        $migrationPaths = $this->app->make('migrator')->paths();
        $expectedMigrationPath = [realpath(__DIR__.'/../../../src/Database/Migrations')];
        foreach ($expectedMigrationPath as $expectedPath) {
            $this->assertContains(realpath($expectedPath), array_map('realpath', $migrationPaths));
        }

        // Verify that views namespace is added
        $namespacePaths = View::getFinder()->getHints();
        $expectedViewPath = realpath(__DIR__.'/../../../resources/views');
        $this->assertArrayHasKey('youtubeupload', $namespacePaths);
        //dd($expectedViewPath, $namespacePaths['youtubeupload']);
        foreach ($expectedMigrationPath as $expectedPath) {
            $this->assertContains($expectedViewPath, array_map('realpath', $namespacePaths['youtubeupload']));
        }
    }

    public function testRegisterMethod()
    {
        // Verify TokenService singleton binding
        $this->assertInstanceOf(TokenService::class, $this->app->make(TokenService::class));

        // Verify publishes commands
        $this->artisan('vendor:publish', ['--tag' => 'youtubeupload-commands'])
            ->assertExitCode(0);

        // Verify publishes migrations
        $this->artisan('vendor:publish', ['--tag' => 'youtubeupload-migrations'])
            ->assertExitCode(0);

        // Verify publishes config
        $this->artisan('vendor:publish', ['--tag' => 'youtubeupload-config'])
            ->assertExitCode(0);

        // Verify publishes views and JS
        $this->artisan('vendor:publish', ['--tag' => 'youtubeupload-views'])
            ->assertExitCode(0);
    }

    public function testConfigurePackageMethod()
    {
        $package = new \Spatie\LaravelPackageTools\Package();
        $provider = new YoutubeUploadServiceProvider($this->app);
        $provider->configurePackage($package);

        // Verify package configuration
        $this->assertEquals('youtubeupload', $package->name);
        $this->assertTrue($package->hasViews);
    }

    public function test_it_registers_package_to_service_container()
    {
        // Arrange
        $app = $this->createApplication();

        // Act
        $provider = new YoutubeUploadServiceProvider($app);
        $provider->packageRegistered();

        //Assert
        $this->assertTrue($app->bound(YoutubeUpload::class));
        $this->assertTrue($app->bound('youtubeupload'));
        $this->assertSame($app->make(YoutubeUpload::class), $app->make('youtubeupload'));
    }

    public function testConfigurationIsPublished()
    {
        $this->artisan('vendor:publish', ['--tag' => 'youtubeupload-config'])
            ->assertExitCode(0);

        $this->assertFileExists(config_path('youtubeupload.php'));
    }

    public function testMigrationsArePublished()
    {
        $this->artisan('vendor:publish', ['--tag' => 'youtubeupload-migrations'])
            ->assertExitCode(0);

        $this->assertDirectoryExists(database_path('migrations'));
    }

    public function testViewsArePublished()
    {
        $this->artisan('vendor:publish', ['--tag' => 'youtubeupload-views'])
            ->assertExitCode(0);

        $this->assertDirectoryExists(resource_path('views/youtubeupload'));
    }

    public function testAliasesAreRegistered()
    {
        $provider = new YoutubeUploadServiceProvider($this->app);
        $provider->packageRegistered();

        $this->assertTrue($this->app->isAlias('youtubeupload'));
    }

    public function testViewNamespaceIsAdded()
    {
        $provider = new YoutubeUploadServiceProvider($this->app);
        $provider->boot();

        $namespacePaths = View::getFinder()->getHints();
        $expectedViewPath = realpath(__DIR__.'/../../../resources/views');

        $this->assertArrayHasKey('youtubeupload', $namespacePaths);
        $this->assertContains($expectedViewPath, array_map('realpath', $namespacePaths['youtubeupload']));
    }

    public function testRoutesAreLoaded()
    {
        $this->assertNotEmpty($this->app['router']->getRoutes());
    }

    public function testTokenServiceSingleton()
    {
        $this->assertInstanceOf(TokenService::class, $this->app->make(TokenService::class));
    }

    public function test_package_registered_method()
    {
        $app = $this->app;

        $provider = new YoutubeUploadServiceProvider($app);
        $provider->packageRegistered();

        // Vérifiez que YoutubeUpload est enregistré comme singleton
        $this->assertTrue($app->bound(YoutubeUpload::class));

        // Vérifiez que l'alias youtubeupload est enregistré
        $this->assertSame($app->make(YoutubeUpload::class), $app->make('youtubeupload'));
    }

    public function test_configure_package_method()
    {
        $package = new Package();
        $provider = new YoutubeUploadServiceProvider($this->app);
        $provider->configurePackage($package);

        $this->assertEquals('youtubeupload', $package->name);
        $this->assertTrue($package->hasViews);
    }

    public function test_it_registers_the_factories_namespace()
    {
        // Créez une instance de votre service provider
        $provider = new YoutubeUploadServiceProvider($this->app);

        // Utilisez la réflexion pour appeler la méthode protégée registerFactories
        $reflection = new ReflectionMethod($provider, 'registerFactories');
        $reflection->setAccessible(true);
        $reflection->invoke($provider);
        $this->addToAssertionCount(1);
    }

    public function test_it_registers_factories()
    {
        // Arrange
        $serviceProvider = new YoutubeUploadServiceProvider(app());
        $expectedNamespace = '\Leknoppix\YoutubeUpload\Database\Factories';

        // Crée un nouvel objet ReflectionMethod
        $method = new ReflectionMethod($serviceProvider, 'registerFactories');
        // Définit la méthode accessible
        $method->setAccessible(true);

        // Act
        $method->invoke($serviceProvider);

        // Check the namespace set in the FactoryWrapper
        $actualNamespace = FactoryWrapper::getNamespace();

        // Assert
        $this->assertEquals($expectedNamespace, $actualNamespace);
    }
}
