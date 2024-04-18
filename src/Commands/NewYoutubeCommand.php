<?php

namespace Leknoppix\NewYoutube\Commands;

use Illuminate\Console\Command;

class NewYoutubeCommand extends Command
{
    public $signature = 'newyoutube';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
