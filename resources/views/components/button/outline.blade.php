@props([
    'href' => null,
    'type' => 'button',
])

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'flex items-center justify-center text-label-medium font-bold border-3 border-secondary hover:border-foreground/40 hover:text-foreground/40 rounded-2xl px-4 py-3 transition-colors']) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => 'flex items-center justify-center text-label-medium font-bold border-3 border-secondary hover:border-foreground/40 hover:text-foreground/40 rounded-2xl px-4 py-3 transition-colors cursor-pointer']) }}>
        {{ $slot }}
    </button>
@endif