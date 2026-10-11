@props(['action', 'name', 'note' => null, 'label' => 'Delete', 'small' => true])
<div x-data="{ open: false }" class="inline">
    <button type="button" class="btn {{ $small ? 'btn-sm' : '' }} btn-danger-outline" @click="open = true"><x-icon name="trash" size="sm" />{{ $label }}</button>
    <div class="modal-backdrop" x-show="open" x-cloak @keydown.escape.window="open = false">
        <form class="modal" method="POST" action="{{ $action }}" @click.outside="open = false">
            @csrf
            @method('DELETE')
            <h3>Delete {{ $name }}?</h3>
            <p>{{ $note ?? 'This can\'t be undone.' }}</p>
            <div class="acts">
                <button class="btn btn-outline" type="button" @click="open = false">Cancel</button>
                <button class="btn btn-danger" type="submit">Delete</button>
            </div>
        </form>
    </div>
</div>
