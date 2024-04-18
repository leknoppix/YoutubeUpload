<?php

namespace Leknoppix\YoutubeUpload\Commands;

use Illuminate\Console\Command;

class YoutubeUploadCommand extends Command
{
    public $signature = 'youtubeuploadcommand';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
