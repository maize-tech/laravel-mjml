<?php

namespace Maize\Mjml\Commands;

use Illuminate\Console\Command;

class MjmlCommand extends Command
{
    public $signature = 'laravel-mjml';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
