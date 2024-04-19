<?php

namespace Leknoppix\YoutubeUpload\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Leknoppix\YoutubeUpload\Models\YoutubeUploadAccessToken;


class ModelFactory extends Factory
{
    protected $model = YoutubeUploadAccessToken::class;

    public function definition()
    {
        return [
            'channel_name' => $this->faker->company,
            'channel_id' => $this->faker->uuid,
            'access_token' => $this->faker->uuid
        ];
    }
}

