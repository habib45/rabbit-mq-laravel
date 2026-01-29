<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Application Logs') }}
        </h2>
    </x-slot>
    @include('../jobs_button')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Log Entries</h3>

                    <form method="GET" action="{{ route('logs.index') }}" class="mb-4">
                        <div class="flex">
                            <input type="text" name="search" placeholder="Search logs..."
                                   value="{{ request('search') }}"
                                   class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full sm:w-1/3">
                            <x-primary-button class="ms-3 mt-1">
                                {{ __('Search') }}
                            </x-primary-button>
                        </div>
                    </form>

                    @if ($logs->isEmpty())
                    <p>No log entries found.</p>
                    @else
                    <div class="border-base-content/25 w-full overflow-x-auto border">
                        <table class="items-center bg-transparent w-full border-collapse ">
                            <thead class="bg-gray-200 pt-4">
                                <tr>
                                    <th scope="col"
                                        class="px-6 p-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Level
                                    </th>
                                    <th scope="col"
                                        class="px-6 p-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Application
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Message
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Time
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">View</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($logs as $log)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $log->level }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $log->application }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ Str::limit($log->message, 80) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $log->created_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('logs.show', $log->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900">View</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 bg-white">
                        {{ $logs->appends(['search' => request('search')])->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>