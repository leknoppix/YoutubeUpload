<?php

namespace Leknoppix\YoutubeUpload\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadAccessToken;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadChannel;

/**
 * @extends Factory<YoutubeUploadAccessToken>
 */
class YoutubeUploadAccessTokenFactory extends Factory
{
    protected $model = YoutubeUploadAccessToken::class;

    /**
     * Define the model's default state.
     *
     * array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'channel_id' => YoutubeUploadChannel::factory(),
            'access_token' => $this->faker->uuid,
        ];
    }
}
