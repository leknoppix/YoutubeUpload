<?php

namespace Leknoppix\YoutubeUpload\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadVideo;

/**
 * @extends Factory<YoutubeUploadVideo>
 */
class YoutubeUploadVideoFactory extends Factory
{
    protected $model = YoutubeUploadVideo::class;

    /**
     * Define the model's default state.
     *
     * array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'channel_id' => $this->faker->randomNumber(),
            'description' => $this->faker->text(5),
            'videoId' => $this->faker->uuid,
            'url' => $this->faker->url,
            'is_published' => $this->faker->boolean,
            'is_owner' => $this->faker->boolean,
            'videocategory_id' => $this->faker->randomNumber(),
            'user_id' => $this->faker->randomNumber(),
        ];
    }
}
