{{-- Shared by create and edit. Expects $attraction and $countries. --}}
@if ($errors->any())
    <div class="alert alert-error"><x-icon name="alert" /><div>Please fix the highlighted fields.</div></div>
@endif

<div class="admin-cols">
    <section class="panel">
        <div class="panel-body form-grid">
            <div class="field full">
                <label class="label" for="name">Name</label>
                <input class="input @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $attraction->name) }}" required>
                @error('name')<p class="error">{{ $message }}</p>@enderror
            </div>
            <div class="field">
                <label class="label" for="country_id">Country</label>
                <select class="select @error('country_id') is-invalid @enderror" id="country_id" name="country_id" required>
                    <option value="">Choose…</option>
                    @foreach ($countries as $c)
                        <option value="{{ $c->id }}" @selected((int) old('country_id', $attraction->country_id) === $c->id)>{{ $c->name }}</option>
                    @endforeach
                </select>
                @error('country_id')<p class="error">{{ $message }}</p>@enderror
            </div>
            <div class="field">
                <label class="label" for="city">City or area</label>
                <input class="input @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', $attraction->city) }}">
                @error('city')<p class="error">{{ $message }}</p>@enderror
            </div>
            <div class="field">
                <label class="label" for="type">Type</label>
                <select class="select @error('type') is-invalid @enderror" id="type" name="type">
                    @foreach (App\Models\Attraction::TYPES as $t)
                        <option value="{{ $t }}" @selected(old('type', $attraction->type) === $t)>{{ $t }}</option>
                    @endforeach
                </select>
                <p class="help">Used by the trip planner to match trip types.</p>
                @error('type')<p class="error">{{ $message }}</p>@enderror
            </div>
            <div class="field full">
                <label class="label" for="description">Description</label>
                <textarea class="textarea @error('description') is-invalid @enderror" id="description" name="description" required>{{ old('description', $attraction->description) }}</textarea>
                <p class="help">What it is, and one practical tip (opening times, tickets, how to get there).</p>
                @error('description')<p class="error">{{ $message }}</p>@enderror
            </div>
        </div>
    </section>

    <section class="panel">
        @if ($attraction->image)<img class="form-photo" src="{{ $attraction->image_url }}" alt="">@endif
        <div class="panel-body">
            <div class="field">
                <label class="label" for="image">{{ $attraction->image ? 'Replace photo' : 'Upload photo' }}</label>
                <input class="input" type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp">
                <p class="help">JPG, PNG or WebP up to 4 MB.</p>
                @error('image')<p class="error">{{ $message }}</p>@enderror
            </div>
            <div class="field">
                <label class="label" for="image_credit">Photo credit</label>
                <input class="input" id="image_credit" name="image_credit" value="{{ old('image_credit', $attraction->image_credit) }}" placeholder="Photographer / licence">
            </div>
        </div>
    </section>
</div>
