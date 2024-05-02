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
     * Formatage de la date de création
     *
     * @return string
     */
    public function FormattedCreatedAt()
    {
        $date = $this->created_at->format('U');
        if (DB::getDriverName() == 'sqlite') {
            $date = $date / 1000;
        }
        $date = Carbon::createFromTimestamp($date);

        return $date->format('d-m-Y H:i:s');
    }

    /**
     * Formatage de la date de mise a jour
     *
     * @return string
     */
    public function FormattedUpdatedAt()
    {
        $date = $this->updated_at->format('U');
        if (DB::getDriverName() == 'sqlite') {
            $date = $date / 1000;
        }
        $date = Carbon::createFromTimestamp($date);

        return $date->format('d-m-Y H:i:s');
    }
}
