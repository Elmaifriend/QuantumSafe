@extends('layouts.app')

@section('title', 'QuantumSafe')

@section('body')
    <x-hero class="grid grid-rows-[auto_1fr] justify-stretch max-w-3xl py-2 !gap-4">
        <div class="container grid grid-cols-[auto_1fr] gap-4 justify-center">
            <div class="flex flex-col items-center justify-center gap-1 p-4 text-foreground-tertiary">
                <i class="bx bx-file !text-8xl"></i>
                <span class="text-label-medium">{{ $fileName }}</span>
            </div>
            <div class="flex flex-col gap-1">
                <h1 class="text-headline-medium font-[Red_Hat_Display]">{{ $fileName }}</h1>
                <x-metadata-view name="Nombre" value="{{ $fileName }}"></x-metadata-view>
                <x-metadata-view name="Fecha" value="{{ $fileDate }}"></x-metadata-view>
                <x-metadata-view name="Tamaño" value="{{ $fileSize }}"></x-metadata-view>
            </div>
        </div>

        <div class="w-full h-full bg-background rounded-2xl shadow-xl">
                <iframe 
                    src="{{ route('files.preview', ['id' => $fileId]) }}"
                    class="w-full h-full rounded-2xl border-none"
                    frameborder="0"
                ></iframe>
        </div>
    </x-hero>
@endsection
