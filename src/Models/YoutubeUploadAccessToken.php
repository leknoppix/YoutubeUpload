<?php

namespace Leknoppix\YoutubeUpload\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoutubeUploadAccessToken extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'channel_id',
        'channel_name',
        'access_token',
    ];
}
