{{-- Shared by create and edit. Expects $hotel and $countries. --}}
@if ($errors->any())
    <div class="alert alert-error"><x-icon name="alert" /><div>Please fix the highlighted fields.</div></div>
@endif

<div class="admin-cols">
    <section class="panel">
        <div class="panel-body form-grid">
            <div class="field full">
                <label class="label" for="name">Hotel name</label>
                <input class="input @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $hotel->name) }}" required>
                @error('name')<p class="error">{{ $message }}</p>@enderror
            </div>
            <div class="field">
                <label class="label" for="country_id">Country</label>
                <select class="select @error('country_id') is-invalid @enderror" id="country_id" name="country_id" required>
                    <option value="">Choose…</option>
                    @foreach ($countries as $c)
                        <option value="{{ $c->id }}" @selected((int) old('country_id', $hotel->country_id) === $c->id)>{{ $c->name }}</option>
                    @endforeach
                </select>
                @error('country_id')<p class="error">{{ $message }}</p>@enderror
            </div>
            <div class="field">
                <label class="label" for="city">City</label>
                <input class="input @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', $hotel->city) }}">
                @error('city')<p class="error">{{ $message }}</p>@enderror
            </div>
            <div class="field">
                <label class="label" for="stars">Official star rating</label>
                <select class="select @error('stars') is-invalid @enderror" id="stars" name="stars">
                    @foreach ([5, 4, 3, 2, 1] as $s)
                        <option value="{{ $s }}" @selected((int) old('stars', $hotel->stars) === $s)>{{ $s }} {{ Str::plural('star', $s) }}</option>
                    @endforeach
                </select>
                @error('stars')<p class="error">{{ $message }}</p>@enderror
            </div>
            <div class="field">
                <label class="label" for="price_per_night">Typical price per night</label>
                <div class="input-group"><span class="addon">SAR</span><input class="input @error('price_per_night') is-invalid @enderror" type="number" min="0" step="10" id="price_per_night" name="price_per_night" value="{{ old('price_per_night', $hotel->price_per_night) }}" required></div>
                @error('price_per_night')<p class="error">{{ $message }}</p>@enderror
            </div>
            <div class="field full">
                <label class="label" for="description">Short description</label>
                <textarea class="textarea @error('description') is-invalid @enderror" id="description" name="description" required>{{ old('description', $hotel->description) }}</textarea>
                <p class="help">One line on where it is or what it's known for.</p>
                @error('description')<p class="error">{{ $message }}</p>@enderror
            </div>
        </div>
    </section>

    <section class="panel">
        @if ($hotel->image)<img class="form-photo" src="{{ $hotel->image_url }}" alt="">@endif
        <div class="panel-body">
            <div class="field">
                <label class="label" for="image">{{ $hotel->image ? 'Replace photo' : 'Upload photo' }}</label>
                <input class="input" type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp">
                <p class="help">JPG, PNG or WebP up to 4 MB.</p>
                @error('image')<p class="error">{{ $message }}</p>@enderror
            </div>
            <div class="field">
                <label class="label" for="image_credit">Photo credit</label>
                <input class="input" id="image_credit" name="image_credit" value="{{ old('image_credit', $hotel->image_credit) }}" placeholder="Photographer / licence">
            </div>
        </div>
    </section>
</div>
