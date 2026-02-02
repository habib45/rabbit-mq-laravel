<?php

namespace App\Http\Controllers;

use App\Jobs\TestEmailJob;
use App\Jobs\TestJob;
use App\Jobs\TestQueue;
use App\Models\Log;
// use Illuminate\Support\Facades\Queue;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        return view('jobs');
    }

    public function dispatchTestJob()
    {
        TestJob::dispatch();
        Log::create([
            'level' => 'info',
            'application' => 'web-app',
            'message' => 'TestJob dispatched.',
            'context' => ['job_name' => 'TestJob'],
        ]);

        return redirect()->back()->with('status', 'Test job dispatched successfully!');
    }

    public function dispatchTestEmailJob()
    {
        // $queue = Queue::connection('rabbitmq')->getChannel();
        // $channel = $queue->getChannel();
        TestEmailJob::dispatch()
            ->onConnection('rabbitmq')
            ->onQueue('test_channel');
        Log::create([
            'level' => 'info',
            'application' => 'web-app',
            'message' => 'TestEmailJob dispatched.',
            'context' => ['job_name' => 'TestEmailJob'],
        ]);

        return redirect()->back()->with('status', 'Test email job dispatched successfully!');
    }

    public function dispatchTestChannelJob()
    {
        TestEmailJob::dispatch()
            ->onConnection('rabbitmq')
            ->onQueue('channel-1');
        // TestEmailJob::dispatch()->onConnection('rabbitmq-test-channel')->onQueue('test_channel');
        Log::create([
            'level' => 'info',
            'application' => 'web-app',
            'message' => 'TestEmailJob dispatched to test channel.',
            'context' => ['job_name' => 'TestEmailJob', 'channel' => 'rabbitmq-test-channel'],
        ]);

        return redirect()->back()->with('status', 'Test email job dispatched successfully!');
    }

    public function dispatchTestQueue(Request $request)
    {
        $data = [
            'name' => 'Jon Doe',
            'phone' => '12345678901',
        ];

        TestQueue::dispatch($data)->onConnection('rabbitmq')->onQueue('user_create_queue');
        Log::create([
            'level' => 'info',
            'application' => 'web-app',
            'message' => 'TestQueue dispatched.',
            'context' => ['job_name' => 'TestQueue', 'data' => $data],
        ]);

        return redirect()->back()->with('status', 'Test queue job dispatched successfully!');
    }
}
