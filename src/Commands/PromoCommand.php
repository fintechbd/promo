<?php

namespace Fintech\Promo\Commands;

use Illuminate\Console\Command;

class PromoCommand extends Command
{
    public $signature = 'promo';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
