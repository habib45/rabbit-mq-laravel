<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\TestJob;
use App\Jobs\TestEmailJob;

class JobController extends Controller
{
    public function index()
    {
        return view('jobs');
    }

    public function dispatchTestJob()
    {
        TestJob::dispatch();
        // TestJob::dispatch()->onConnection('rabbitmq-test-channel');
        return redirect()->route('jobs.index')->with('status', 'Test job dispatched successfully!');
    }

    public function dispatchTestEmailJob()
    {
        // TestEmailJob::dispatch();
        // TestEmailJob::dispatch()->onConnection('web-app');
        TestEmailJob::dispatch()->onConnection('rabbitmq')->onQueue('test_channel');
        return redirect()->route('jobs.index')->with('status', 'Test email job dispatched successfully!');
    }


    public function dispatchTestChannelJob()
    {
        TestEmailJob::dispatch()->onConnection('rabbitmq-test-channel');
        return redirect()->route('jobs.index')->with('status', 'Test email job dispatched successfully!');
    }
}