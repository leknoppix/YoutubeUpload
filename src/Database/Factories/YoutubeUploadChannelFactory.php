<?php

namespace Leknoppix\YoutubeUpload\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadChannel;

/**
 * @extends Factory<YoutubeUploadChannel>
 */
class YoutubeUploadChannelFactory extends Factory
{
    protected $model = YoutubeUploadChannel::class;

    /**
     * Define the model's default state.
     *
     * array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'channel_name' => $this->faker->company,
            'channel_YT_id' => $this->faker->uuid,
            'is_favorite' => 'no',
            'get_video_list' => 'no',
        ];
    }
}
