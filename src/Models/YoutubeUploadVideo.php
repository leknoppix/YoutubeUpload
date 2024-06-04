<?php

namespace Leknoppix\YoutubeUpload\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class YoutubeUploadVideo extends Model
{
    use HasFactory;

    // public int $user_id;

    // public int $channel_id;

    /**
     * @return BelongsTo<YoutubeUploadChannel, YoutubeUploadVideo>
     */
    public function channel(): BelongsTo
    {
        return $this->belongsTo(YoutubeUploadChannel::class, 'channel_id');
    }

    protected $table = 'youtubeupload_videos';

    protected $guarded = [];

    protected $fillable = [
        'channel_id',
        'title',
        'description',
        'videoId',
        'url',
        'urlimage',
        'duration',
        'is_published',
        'is_owner',
        'videocategory_id',
        'user_id',
    ];
}
