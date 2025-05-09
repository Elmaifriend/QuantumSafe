@props([
    'type' => 'static',
])

@if ($type == 'static')
    <div {{ $attributes->merge() }}>
        <div class="drop-shadow-highlight drop-shadow-[0_0_4px]">
            <div class="drop-shadow-highlight/40 drop-shadow-[0_0_7px]">
                <div class="drop-shadow-highlight/60 drop-shadow-[0_0_20px]">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
@elseif ($type == 'hover')
    <div {{ $attributes->merge() }}>
        <div class="drop-shadow-highlight transition-all hover:drop-shadow-[0_0_4px]">
            <div class="drop-shadow-highlight/40 transition-all hover:drop-shadow-[0_0_7px]">
                <div class="drop-shadow-highlight/60 transition-all hover:drop-shadow-[0_0_20px]">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
@endif
