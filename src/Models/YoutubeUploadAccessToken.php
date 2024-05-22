<?php

namespace Leknoppix\YoutubeUpload\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoutubeUploadAccessToken extends Model
{
    use HasFactory;

    const IS_FAVORITE_YES = 'yes';

    const IS_FAVORITE_NO = 'no';

    protected $table = 'youtubeupload_access_token';

    protected $guarded = [];

    protected string $access_token;

    /**
     * @return string|array<string, int|string>
     */
    public function getAccessTokenAttribute(): string|array
    {
        return $this->attributes['access_token'];
    }

    protected string $channel_id;

    public function getChannelIdAttribute(): string
    {
        return $this->attributes['channel_id'];
    }

    protected string $is_favorite;

    public function getIsFavoriteAttribute(): string
    {
        return $this->attributes['is_favorite'];
    }

    protected $fillable = [
        'channel_id',
        'channel_name',
        'access_token',
        'is_favorite',
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
