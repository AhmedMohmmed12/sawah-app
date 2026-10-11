{{-- Name and email. Expects $user and $action. --}}
<section class="panel" id="details">
    <div class="panel-head"><div><h2>Your details</h2><p>Your name and the email address you sign in with.</p></div></div>
    <form class="panel-body" method="POST" action="{{ $action }}">
        @csrf
        @method('patch')
        <div class="form-grid">
            <div class="field">
                <label class="label" for="name">Name</label>
                <input class="input @error('name') is-invalid @enderror" id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autocomplete="name">
                @error('name')<p class="error">{{ $message }}</p>@enderror
            </div>
            <div class="field">
                <label class="label" for="email">Email</label>
                <input class="input @error('email') is-invalid @enderror" id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email')<p class="error">{{ $message }}</p>@enderror
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <p class="help">Not verified yet. <button form="send-verification" class="link-button" type="submit">Send the link again</button></p>
                @endif
            </div>
        </div>
        <button class="btn" type="submit">Save details</button>
    </form>
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">@csrf</form>
</section>
