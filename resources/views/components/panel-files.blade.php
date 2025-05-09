@props([
    'files' => []
])

@if(!empty($files))
    <div class="w-full p-4 flex flex-wrap gap-1">
        @foreach ($files as $file)
            <x-file
                file="{{ $file }}"
            ></x-file>
        @endforeach
    </div>
@else
    <div class="w-full h-full flex items-center justify-center">
        @include('layouts.upload-form')
    </div>
@endif