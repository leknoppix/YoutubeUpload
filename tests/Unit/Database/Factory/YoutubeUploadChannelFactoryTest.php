<?php

namespace Leknoppix\YoutubeUpload\Tests\Unit\Database\Factory;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Leknoppix\YoutubeUpload\Database\Factories\YoutubeUploadChannelFactory;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadChannel;
use Leknoppix\YoutubeUpload\Tests\TestCase;

class YoutubeUploadChannelFactoryTest extends TestCase
{
    use RefreshDatabase;
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_channel_factory()
    {
        $channel = YoutubeUploadChannel::factory()->make();

        $this->assertNotEmpty($channel->getAttribute('channel_name'));
        $this->assertNotEmpty($channel->getAttribute('channel_YT_id'));
    }

    /**
     * Test que la factory crée un modèle valide
     *
     * @return void
     */
    public function test_youtube_upload_channel_factory_creates_valid_model()
    {
        // Utilisation de la factory pour créer un modèle en mémoire
        $channel = (new YoutubeUploadChannelFactory)->make();

        $this->assertInstanceOf(YoutubeUploadChannel::class, $channel);
        $this->assertNotEmpty($channel->getAttribute('channel_name'));
        $this->assertNotEmpty($channel->getAttribute('channel_YT_id'));
        $this->assertEquals('no', $channel->getAttribute('is_favorite'));
        $this->assertEquals('no', $channel->getAttribute('get_video_list'));
    }

    public function test_definition_method_generates_valid_data()
    {
        $factory = new YoutubeUploadChannelFactory;
        $definitions = $factory->definition();

        $this->assertIsArray($definitions);
        $this->assertIsString($definitions['channel_name']);
        $this->assertIsString($definitions['channel_YT_id']);
        $this->assertEquals('no', $definitions['is_favorite']);
        $this->assertEquals('no', $definitions['get_video_list']);
    }

    /**
     * Test que les champs générés par la factory sont corrects
     *
     * @return void
     */
    public function test_youtube_upload_channel_factory_creates_correct_fields()
    {
        // Utilisation de la factory pour créer un modèle en mémoire
        $channel = (new YoutubeUploadChannelFactory)->make();

        $this->assertIsString($channel->getAttribute('channel_name'));
        $this->assertIsString($channel->getAttribute('channel_YT_id'));
        $this->assertIsString($channel->getAttribute('is_favorite'));
        $this->assertIsString($channel->getAttribute('get_video_list'));

        // Vérifie que les champs ont des valeurs valides
        $this->assertMatchesRegularExpression('/^[\w-]+$/', $channel->getAttribute('channel_YT_id'));
        $this->assertContains($channel->getAttribute('is_favorite'), ['yes', 'no']);
        $this->assertContains($channel->getAttribute('get_video_list'), ['yes', 'no']);
    }
}
