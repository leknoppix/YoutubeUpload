<?php

namespace Leknoppix\YoutubeUpload\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class YoutubeUploadAccessToken extends Model
{
    use HasFactory;

    protected $table = 'youtubeupload_access_tokens';

    protected $guarded = [];

    public string $access_token = '';

    protected string $channel_id;

    /**
     * @return BelongsTo<YoutubeUploadChannel, YoutubeUploadAccessToken>
     */
    public function channel(): BelongsTo
    {
        return $this->belongsTo(YoutubeUploadChannel::class, 'channel_id');
    }

    protected $fillable = [
        'channel_id',
        'access_token',
    ];

    /**
     * Get the formatted created_at timestamp.
     *
     * @param  Carbon  $value
     */
    public function getCreatedAtAttribute($value): string
    {
        return Carbon::parse($value)->format('d-m-Y H:i:s');
    }

    /**
     * Get the formatted updated_at timestamp.
     *
     * @param  Carbon  $value
     */
    public function getUpdatedAtAttribute($value): string
    {
        return Carbon::parse($value)->format('d-m-Y H:i:s');
    }
}
