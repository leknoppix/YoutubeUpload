<?php

namespace Leknoppix\YoutubeUpload\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
