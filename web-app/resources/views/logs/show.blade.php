<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Log Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Log Entry Details</h3>
                    <div class="border-b border-gray-200 py-2">
                        <p><span class="font-semibold">ID:</span> {{ $log->id }}</p>
                        <p><span class="font-semibold">Level:</span> {{ $log->level }}</p>
                        <p><span class="font-semibold">Application:</span> {{ $log->application }}</p>
                        <p><span class="font-semibold">Message:</span> {{ $log->message }}</p>
                        <p><span class="font-semibold">Created At:</span> {{ $log->created_at }}</p>
                        <p><span class="font-semibold">Updated At:</span> {{ $log->updated_at }}</p>
                    </div>

                    @if ($log->context)
                        <div class="mt-6">
                            <h4 class="font-semibold text-md text-gray-900">Context:</h4>
                            <pre class="bg-gray-100 p-4 rounded-md mt-2 text-sm">{{ json_encode($log->context, JSON_PRETTY_PRINT) }}</pre>
                        </div>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('logs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Back to Logs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
