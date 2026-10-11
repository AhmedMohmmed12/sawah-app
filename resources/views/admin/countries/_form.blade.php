{{-- Shared by create and edit. Expects $country. --}}
@if ($errors->any())
    <div class="alert alert-error"><x-icon name="alert" /><div>Please fix the highlighted fields.</div></div>
@endif

<div class="admin-cols">
    <div>
        <section class="panel">
            <div class="panel-head"><div><h2>Basics</h2></div></div>
            <div class="panel-body form-grid">
                <div class="field">
                    <label class="label" for="name">Name</label>
                    <input class="input @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $country->name) }}" required>
                    @error('name')<p class="error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="label" for="code">Country code</label>
                    <input class="input mono @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code', $country->code) }}" maxlength="2" placeholder="JP" required>
                    <p class="help">Two-letter ISO code.</p>
                    @error('code')<p class="error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="label" for="capital">Capital <span class="opt">(optional)</span></label>
                    <input class="input @error('capital') is-invalid @enderror" id="capital" name="capital" value="{{ old('capital', $country->capital) }}">
                    @error('capital')<p class="error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="label" for="region">Region <span class="opt">(optional)</span></label>
                    <input class="input @error('region') is-invalid @enderror" id="region" name="region" value="{{ old('region', $country->region) }}" list="regions" placeholder="Europe">
                    <datalist id="regions">
                        @foreach (['Europe', 'Middle East', 'Africa', 'Asia', 'Caucasus', 'Indian Ocean', 'Americas'] as $r)<option value="{{ $r }}">@endforeach
                    </datalist>
                    @error('region')<p class="error">{{ $message }}</p>@enderror
                </div>
                <div class="field full">
                    <label class="label" for="description">Description</label>
                    <textarea class="textarea @error('description') is-invalid @enderror" id="description" name="description" required>{{ old('description', $country->description) }}</textarea>
                    <p class="help">One or two specific sentences. The first sentence is also used on the home page list.</p>
                    @error('description')<p class="error">{{ $message }}</p>@enderror
                </div>
            </div>
        </section>

        <section class="panel">
            <div class="panel-head"><div><h2>Money and weather</h2></div></div>
            <div class="panel-body form-grid">
                <div class="field">
                    <label class="label" for="daily_budget_min">Daily budget from</label>
                    <div class="input-group"><span class="addon">SAR</span><input class="input @error('daily_budget_min') is-invalid @enderror" type="number" min="0" step="10" id="daily_budget_min" name="daily_budget_min" value="{{ old('daily_budget_min', $country->daily_budget_min) }}" required></div>
                    @error('daily_budget_min')<p class="error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="label" for="daily_budget_max">Daily budget to</label>
                    <div class="input-group"><span class="addon">SAR</span><input class="input @error('daily_budget_max') is-invalid @enderror" type="number" min="0" step="10" id="daily_budget_max" name="daily_budget_max" value="{{ old('daily_budget_max', $country->daily_budget_max) }}" required></div>
                    @error('daily_budget_max')<p class="error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="label" for="currency">Currency</label>
                    <input class="input mono @error('currency') is-invalid @enderror" id="currency" name="currency" value="{{ old('currency', $country->currency) }}" maxlength="3" placeholder="EUR" required>
                    <p class="help">Three-letter code, used to fetch the daily rate.</p>
                    @error('currency')<p class="error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="label" for="exchange_rate_to_sar">Riyals per 1 unit</label>
                    <input class="input mono @error('exchange_rate_to_sar') is-invalid @enderror" type="number" min="0" step="any" id="exchange_rate_to_sar" name="exchange_rate_to_sar" value="{{ old('exchange_rate_to_sar', $country->exchange_rate_to_sar) }}" required>
                    <p class="help">Updated automatically once a day.</p>
                    @error('exchange_rate_to_sar')<p class="error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="label" for="climate">Climate</label>
                    <select class="select @error('climate') is-invalid @enderror" id="climate" name="climate">
                        @foreach (['Warm', 'Mild', 'Cold'] as $c)
                            <option value="{{ $c }}" @selected(old('climate', $country->climate) === $c)>{{ $c }}</option>
                        @endforeach
                    </select>
                    @error('climate')<p class="error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="label" for="best_months">Best time to go <span class="opt">(optional)</span></label>
                    <input class="input @error('best_months') is-invalid @enderror" id="best_months" name="best_months" value="{{ old('best_months', $country->best_months) }}" placeholder="Apr–Jun, Sep–Oct">
                    @error('best_months')<p class="error">{{ $message }}</p>@enderror
                </div>
            </div>
        </section>
    </div>

    <section class="panel">
        <div class="panel-head"><div><h2>Photo</h2></div></div>
        <div class="panel-body">
            @if ($country->image)
                <img class="form-photo" src="{{ $country->image_url }}" alt="">
            @endif
            <div class="field">
                <label class="label" for="image">{{ $country->image ? 'Replace photo' : 'Upload photo' }}</label>
                <input class="input" type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp">
                <p class="help">Landscape, at least 1600 px wide. JPG, PNG or WebP up to 4 MB.</p>
                @error('image')<p class="error">{{ $message }}</p>@enderror
            </div>
            <div class="field">
                <label class="label" for="image_caption">What's in the photo</label>
                <input class="input" id="image_caption" name="image_caption" value="{{ old('image_caption', $country->image_caption) }}" placeholder="Kiyomizu-dera, Kyoto">
            </div>
            <div class="field">
                <label class="label" for="image_credit">Photo credit</label>
                <input class="input" id="image_credit" name="image_credit" value="{{ old('image_credit', $country->image_credit) }}" placeholder="Photographer / licence">
                <p class="help">Required for Creative Commons photos.</p>
            </div>
        </div>
    </section>
</div>
