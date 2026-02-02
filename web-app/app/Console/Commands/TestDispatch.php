<?php

namespace App\Console\Commands;

use App\Jobs\TestEmailJob;
use Illuminate\Console\Command;

class TestDispatch extends Command
{
    protected $signature = 'app:test-dispatch';

    protected $description = 'Dispatches a test job';

    public function handle()
    {
        TestEmailJob::dispatch()->onConnection('web-app');
        $this->info('Job dispatched!');
    }
}
