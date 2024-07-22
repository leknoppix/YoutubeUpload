<?php

namespace Leknoppix\YoutubeUpload\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Leknoppix\YoutubeUpload\Database\Factories\YoutubeUploadChannelFactory;

class YoutubeUploadChannel extends Model
{
    use HasFactory;

    const IS_FAVORITE_YES = 'yes';

    const IS_FAVORITE_NO = 'no';

    protected $table = 'youtubeupload_channel';

    protected $guarded = [];

    protected string $channel_YT_id;

    protected string $is_favorite;

    protected static function newFactory(): YoutubeUploadChannelFactory
    {
        return YoutubeUploadChannelFactory::new();
    }

    /**
     * @return HasMany<YoutubeUploadVideo>
     */
    public function videos(): HasMany
    {
        return $this->hasMany(YoutubeUploadVideo::class, 'channel_id');
    }

    /**
     * @return HasOne<YoutubeUploadAccessToken>
     */
    public function accesstokens(): HasOne
    {
        return $this->HasOne(YoutubeUploadAccessToken::class, 'channel_id');
    }

    protected $fillable = [
        'channel_name',
        'channel_YT_id',
        'is_favorite',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function ($channel) {
            $channel->videos()->delete();
            $channel->accessTokens()->delete();
        });
    }

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

    /**
     * Get the ID attribute and force it to be an integer.
     */
    public function getIdAttribute(int|string|null $value): int
    {
        return intval($value);
    }
}
