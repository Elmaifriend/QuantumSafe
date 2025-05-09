@props([
    'files' => []
])

@if(!empty($files))
    <div class="w-full p-4 flex flex-wrap gap-1">
        @foreach ($files as $file)
            <div
                x-data="{ selected: false }"
                x-bind:style="if (selected) return {
                    'background': 'var(--color-tertiary)',
                    'border': '3px var(--color-foreground-secondary) dashed'
                }"
                x-on:click="selected = !selected"
                x-on:click.outside="selected = false"
                class="flex flex-col items-center justify-center gap-1 break-all w-[100px] h-full min-h-[100px] cursor-pointer text-foreground-tertiary hover:bg-tertiary rounded-2xl hover:text-foreground/70"
            >
                <i class="bx bx-file !text-[52px]"></i>
                <span class="text-label-medium w-full text-center">{{ $file }}</span>
            </div>
        @endforeach
    </div>
@else
    <div class="w-full h-full flex items-center justify-center">
        @include('layouts.upload-form')
    </div>
@endif