@props(['count' => 0])
<span {{ $attributes->merge(['class' => 'stars']) }} title="{{ $count }}-star hotel" aria-label="{{ $count }} stars">{{ str_repeat('★', (int) $count) }}<span class="off">{{ str_repeat('★', max(0, 5 - (int) $count)) }}</span></span>
