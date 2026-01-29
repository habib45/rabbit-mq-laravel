<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
                @endif

                <div class="flex items-center space-x-4">
                    <form method="POST" action="{{ route('jobs.test-job') }}">
                        @csrf
                        <x-primary-button>
                            {{ __('Add Test Job') }}
                        </x-primary-button>
                    </form>
                    &nbsp;&nbsp;
                    <form method="POST" action="{{ route('jobs.test-email-job') }}">
                        @csrf
                        <x-primary-button>
                            {{ __('Add Test Email Send Job') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.py-12 {
    padding-bottom: 0px !important;
}
</style>