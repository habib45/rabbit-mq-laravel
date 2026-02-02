<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class TestQueue implements ShouldQueue
{
    use Queueable;

    private $data;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = $this->data;
        User::query()->firstOrCreate(
            ['phone' => $data['phone']],
            ['name' => $data['name']]
        );
        Log::create([
            'level' => 'info',
            'application' => 'web-app',
            'message' => 'Success: TestQueue has been executed. Data: '.json_encode($data),
            'context' => ['job_name' => 'TestQueue', 'data' => $data],
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
            'message' => 'TestQueue failed!',
            'context' => [
                'job_name' => 'TestQueue',
                'error' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ],
        ]);
    }
}
