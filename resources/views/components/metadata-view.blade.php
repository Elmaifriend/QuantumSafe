@props([
    'name',
    'value',
])

<div class="flex gap-2 justify-between">
    <span class="text-label-medium text-foreground-tertiary">{{ $name }}</span>
    <span class="text-label-medium font-bold text-foreground">{{ $value }}</span>
</div>