<?php

namespace Thecrazybob\PaytabsLaravel\Commands;

use Illuminate\Console\Command;

class PaytabsCommand extends Command
{
    public $signature = 'paytabs-laravel';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
