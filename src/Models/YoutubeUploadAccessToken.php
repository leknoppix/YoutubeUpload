<?php

namespace Leknoppix\YoutubeUpload\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class YoutubeUploadAccessToken extends Model
{
    use HasFactory;

    protected $table = 'youtubeupload_access_token';

    protected $guarded = [];

    protected $fillable = [
        'channel_id',
        'channel_name',
        'access_token',
    ];

    /**
     * Get the formatted created_at timestamp.
     *
     * @param  Carbon  $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return $this->formatTimestamp($value);
    }

    /**
     * Get the formatted updated_at timestamp.
     *
     * @param  Carbon  $value
     * @return string
     */
    public function getUpdatedAtAttribute($value)
    {
        return $this->formatTimestamp($value);
    }

    /**
     * Format the timestamp.
     *
     * @param  Carbon  $value
     * @return string
     */
    private function formatTimestamp($value)
    {
        if (DB::getDriverName() === 'sqlite') {
            return Carbon::createFromTimestampMs($value)->format('Y-m-d H:i:s');
        } else {
            return Carbon::createFromTimestamp($value)->format('Y-m-d H:i:s');
        }
    }
}
