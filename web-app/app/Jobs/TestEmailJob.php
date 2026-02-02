<?php

namespace App\Jobs;

use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Throwable;

class TestEmailJob implements ShouldQueue
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
        // Simulate sending an email
        sleep(3);

        Log::create([
            'level' => 'info',
            'application' => 'web-app',
            'message' => 'TestEmailJob processed successfully!',
            'context' => ['job_name' => 'TestEmailJob'],
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
            'message' => 'TestEmailJob failed!',
            'context' => [
                'job_name' => 'TestEmailJob',
                'error' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ],
        ]);
    }
}
