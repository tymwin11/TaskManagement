<div
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $pageTitle }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 col-md-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="form-check col-md-12" style="padding-bottom: 10px;">
                    <label class="font-weight-bold">Title</label>
                    <input type="text" class="form-control @error('title') border-danger @enderror" wire:model.defer="title" {{ $pageTitle == 'View Task' ? 'disabled' : '' }}>
                    @error('title') <p class="text-danger font-sm">{{ $message }}</p> @enderror
                </div>
                <div class="form-check col-md-12">
                    <label class="font-weight-bold">Priority</label>
                    <select class="form-control @error('priority') border-danger @enderror" wire:model.defer="priority" {{ $pageTitle == 'View Task' ? 'disabled' : '' }}>
                        <option value=""></option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                    @error('priority') <p class="text-danger font-sm">{{ $message }}</p> @enderror
                </div>
                @if($pageTitle != 'View Task')
                    <div class="flex justify-between pt-5">
                        <button class="btn btn-danger" wire:click="cancel">
                            Cancel
                        </button>
                        <button class="btn btn-success" wire:click="submit">
                            Submit
                        </button>
                    </div>
                @else
                    <div class="flex justify-between pt-5">
                        <button class="btn btn-info" wire:click="back">
                            Back
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
