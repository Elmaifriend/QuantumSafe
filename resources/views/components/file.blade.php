@props([
    "file",
    "icon" => "bx-file"
])

<div
    x-data="{ selected: false, menu: false }"
    x-bind:style="if (selected && !menu) return {
        'background': 'var(--color-tertiary)',
        'border': '3px var(--color-foreground-secondary) dashed'
    }"
    x-on:click="selected = !selected"
    x-on:click.outside="selected = false"
    class="relative flex flex-col items-center justify-center gap-1 break-all transition-all w-[120px] h-full min-h-[100px] cursor-pointer border-3 border-transparent text-foreground-tertiary hover:bg-tertiary rounded-2xl hover:text-foreground/70"
>
    <i
        x-on:click="menu = !menu"
        class="bx bx-dots-vertical-rounded absolute top-0 right-0 !text-body-large p-1"
    ></i>
    <div
        x-show="menu"
        x-collapse
        class="w-[120px] shadow-lg flex flex-col gap-2 bg-tertiary z-10 py-2 px-4 rounded-xl absolute top-1/3 right-8 translate-x-full"
    >
        <x-button.text class="text-label-medium text-foreground-tertiary">Información</x-button.text>
        <x-button.text class="text-label-medium text-foreground-tertiary">Compartir</x-button.text>
        <x-button.text class="text-label-medium text-foreground-tertiary">Borrar</x-button.text>
    </div>
    <i class="bx {{ $icon }} !text-[52px]"></i>
    <span class="text-label-medium w-full text-center">{{ $file }}</span>
</div>
