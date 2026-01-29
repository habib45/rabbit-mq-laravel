<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\TestEmailJob;

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
