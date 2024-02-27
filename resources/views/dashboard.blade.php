<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="flex justify-between p-2">
                    <label class="text-xl font-semibold">
                        Tasks
                    </label>
                    <a href="{{ route('create-task') }}" type="button" class="btn btn-success text-black">
                        Create Task
                    </a>
                </div>
                <livewire:task-table />
            </div>
        </div>
    </div>
</x-app-layout>
