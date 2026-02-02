<?php

namespace App\Jobs;

use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class TestChannelJob implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::create([
            'level' => 'info',
            'application' => 'web-app',
            'message' => 'TestChannelJob processed successfully!',
            'context' => ['job_name' => 'TestChannelJob'],
        ]);
    }
}
