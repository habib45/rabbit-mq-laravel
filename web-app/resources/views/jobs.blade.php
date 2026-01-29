<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jobs List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('jobs.test-job') }}" class="inline">
                        @csrf
                        <x-primary-button>
                            {{ __('Add Test Job') }}
                        </x-primary-button>
                    </form>

                    <form method="POST" action="{{ route('jobs.test-email-job') }}" class="inline ml-4">
                        @csrf
                        <x-primary-button>
                            {{ __('Add Test Email Send Job') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
