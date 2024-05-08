<?php

namespace Leknoppix\YoutubeUpload\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoutubeUploadVideo extends Model
{
    use HasFactory;

    protected $table = 'youtubeupload_videos';

    protected $guarded = [];

    protected $fillable = [
        'title',
        'description',
        'videoId',
        'url',
    ];
}
