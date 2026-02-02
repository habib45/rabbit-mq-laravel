<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Store a newly created log in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'level' => 'required|string|max:255',
            'application' => 'required|string|max:255',
            'message' => 'required|string',
            'context' => 'nullable|array',
        ]);

        $log = Log::create($validated);

        return response()->json($log, 201);
    }

    /**
     * Display a listing of the logs.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $logs = Log::orderBy('created_at', 'desc');

        if ($search) {
            $logs->where(function ($query) use ($search) {
                $query->where('level', 'like', '%'.$search.'%')
                    ->orWhere('application', 'like', '%'.$search.'%')
                    ->orWhere('message', 'like', '%'.$search.'%');
            });
        }

        $logs = $logs->paginate(15);

        return view('logs.index', compact('logs', 'search'));
    }

    /**
     * Display the specified log.
     */
    public function show(Log $log)
    {
        return view('logs.show', compact('log'));
    }
}
