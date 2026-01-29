<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\TestJob;
use App\Jobs\TestEmailJob;
use App\Models\Log;

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
        TestEmailJob::dispatch()->onConnection('rabbitmq')->onQueue('test_channel');
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
        TestEmailJob::dispatch()->onConnection('rabbitmq-test-channel');
        return redirect()->back()->with('status', 'Test email job dispatched successfully!');
    }
}