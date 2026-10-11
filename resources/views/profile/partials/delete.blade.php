{{-- Expects $action. --}}
<section class="panel panel-danger" id="delete" x-data="{ confirm: {{ $errors->userDeletion->isNotEmpty() ? 'true' : 'false' }} }">
    <div class="panel-head"><div><h2>Delete account</h2><p>This removes your account and saved preferences for good.</p></div></div>
    <div class="panel-body">
        <button class="btn btn-danger-outline" type="button" @click="confirm = true">Delete my account</button>
    </div>

    <div class="modal-backdrop" x-show="confirm" x-cloak @keydown.escape.window="confirm = false">
        <form class="modal" method="POST" action="{{ $action }}" @click.outside="confirm = false">
            @csrf
            @method('delete')
            <h3>Delete your account?</h3>
            <p>Enter your password to confirm. This can't be undone.</p>
            <div class="field">
                <label class="label" for="delete_password">Password</label>
                <input class="input @if ($errors->userDeletion->has('password')) is-invalid @endif" id="delete_password" name="password" type="password" autocomplete="current-password">
                @foreach ($errors->userDeletion->get('password') as $message)<p class="error">{{ $message }}</p>@endforeach
            </div>
            <div class="acts">
                <button class="btn btn-outline" type="button" @click="confirm = false">Cancel</button>
                <button class="btn btn-danger" type="submit">Delete account</button>
            </div>
        </form>
    </div>
</section>
