<section class="panel" id="password">
    <div class="panel-head"><div><h2>Password</h2><p>Use at least 8 characters.</p></div></div>
    <form class="panel-body" method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('put')
        <div class="field">
            <label class="label" for="current_password">Current password</label>
            <input class="input @if ($errors->updatePassword->has('current_password')) is-invalid @endif" id="current_password" name="current_password" type="password" autocomplete="current-password">
            @foreach ($errors->updatePassword->get('current_password') as $message)<p class="error">{{ $message }}</p>@endforeach
        </div>
        <div class="form-grid">
            <div class="field">
                <label class="label" for="new_password">New password</label>
                <input class="input @if ($errors->updatePassword->has('password')) is-invalid @endif" id="new_password" name="password" type="password" autocomplete="new-password">
                @foreach ($errors->updatePassword->get('password') as $message)<p class="error">{{ $message }}</p>@endforeach
            </div>
            <div class="field">
                <label class="label" for="password_confirmation">Repeat new password</label>
                <input class="input" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
            </div>
        </div>
        <button class="btn btn-dark" type="submit">Change password</button>
    </form>
</section>
