@props([
    'name' => 'Item',
    'icon' => 'bx-folder',
    'href' => '#',
])

<div
    x-data="{ selected: false }"
    x-bind:style="if (selected) return {
        'background': 'var(--color-tertiary)',
        'text-color': 'var(--color-foreground-secondary)',
        'font-weight': 'bold',
    }"
    x-on:click="selected = !selected"
    x-on:click.outside="selected = false"
    class="w-full p-3 text-body-small text-foreground-tertiary hover:bg-tertiary rounded-2xl transition-all"
>
    <a class="flex gap-2 items-center" href="{{ $href }}">
        <i class="bx {{ $icon }}"></i>
        <p>{{ $name }}</p>
    </a>
</div>
