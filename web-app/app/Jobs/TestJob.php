<?php

namespace App\Jobs;

use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Throwable;

class TestJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Simulate some work
        sleep(2);

        Log::create([
            'level' => 'info',
            'application' => 'web-app',
            'message' => 'TestJob processed successfully!',
            'context' => ['job_name' => 'TestJob'],
        ]);
    }

    /**
     * Handle a job failure.
     */
    public function failed(Throwable $exception): void
    {
        Log::create([
            'level' => 'error',
            'application' => 'web-app',
            'message' => 'TestJob failed!',
            'context' => [
                'job_name' => 'TestJob',
                'error' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ],
        ]);
    }
}

