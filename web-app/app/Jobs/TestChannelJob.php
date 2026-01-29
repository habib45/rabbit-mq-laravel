<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class TestChannelJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        \Log::info('TestChannelJob processed successfully!');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        \Log::info('TestChannelJob processed successfully!');
    }
}
