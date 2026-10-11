@props(['title', 'subtitle' => null, 'href' => null, 'linkText' => 'View all', 'cols' => 4])
<section {{ $attributes->merge(['class' => 'section']) }} x-data="rail">
    <div class="s-head">
        <div>
            <h2>{{ $title }}</h2>
            @if ($subtitle)<p>{{ $subtitle }}</p>@endif
        </div>
        <div class="acts">
            @if ($href)<a class="all" href="{{ $href }}">{{ $linkText }}</a>@endif
            <button type="button" class="arrow-btn" @click="scroll(-1)" aria-label="Scroll back"><x-icon name="chevron-left" size="sm" /></button>
            <button type="button" class="arrow-btn" @click="scroll(1)" aria-label="Scroll forward"><x-icon name="chevron-right" size="sm" /></button>
        </div>
    </div>
    <div class="rail {{ $cols == 3 ? 'cols-3' : '' }}" x-ref="track">
        {{ $slot }}
    </div>
</section>
