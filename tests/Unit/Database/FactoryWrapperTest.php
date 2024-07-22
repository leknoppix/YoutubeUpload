<?php

namespace Leknoppix\YoutubeUpload\Tests\Unit\Database;

use Leknoppix\YoutubeUpload\Database\FactoryWrapper;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadChannel;
use Leknoppix\YoutubeUpload\Tests\TestCase;

class FactoryWrapperTest extends TestCase
{
    public function test_it_changes_factory_name_guessing_strategy()
    {
        $namespace = 'Leknoppix\\YoutubeUpload\\Database\\Factories';

        // Act
        FactoryWrapper::useNamespace($namespace);
        $factory = YoutubeUploadChannel::factory();  // this should now resolve to YoutubeUploadChannelFactory

        // Assert
        $this->assertInstanceOf($namespace.'\\YoutubeUploadChannelFactory', $factory);
    }

    public function test_it_sets_and_retrieves_namespace()
    {
        // Arrange
        $namespace = 'TestNamespace';
        // Act
        FactoryWrapper::useNamespace($namespace);
        $setNamespace = FactoryWrapper::getNamespace();

        // Assert
        $this->assertEquals($namespace, $setNamespace);
    }
}
