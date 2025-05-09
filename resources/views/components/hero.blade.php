<div class="grid h-svh grid-rows-[90px_1fr] bg-hero bg-cover bg-center">

    @include('layouts.navbar')

    <div {{ $attributes->merge(['class' => 'container mx-auto px-4 flex flex-col justify-center items-center gap-16 justify-items-center']) }}>
        {{ $slot }}
    </div>
</div>
