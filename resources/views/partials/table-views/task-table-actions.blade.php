<div>
    <a href="{{ route('view-task', $model) }}" class="btn btn-info">
        View
    </a>
    <a href="{{ route('edit-task', $model) }}" class="btn btn-warning">
        Edit
    </a>
    @if(auth()->user()->is_admin || $model->user->id == auth()->user()->id)
    <a class="btn btn-danger" wire:click='delete({{ $model }})'>
        Delete
    </a>
    @endif
</div>