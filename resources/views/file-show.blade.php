@extends('layouts.app')

@section('title', 'QuantumSafe')

@section('body')
    <x-hero class="grid grid-rows-[auto_1fr] justify-stretch max-w-3xl py-2 !gap-4">
        <div class="container grid grid-cols-[auto_1fr] gap-4 justify-center">
            <div class="flex flex-col items-center justify-center gap-1 p-4 text-foreground-tertiary">
                <i class="bx bx-file !text-8xl"></i>
                <span class="text-label-medium">Archivo.pdf</span>
            </div>
            <div class="flex flex-col gap-1">
                <h1 class="text-display-medium">Archivo</h1>
                <x-metadata-view
                    name="Nombre"
                    value="Archivo"
                ></x-metadata-view>
                <x-metadata-view
                    name="Tipo"
                    value="Tipo"
                ></x-metadata-view>
                <x-metadata-view
                    name="Fecha"
                    value="Fecha"
                ></x-metadata-view>
                <x-metadata-view
                    name="Tamaño"
                    value="Tamaño"
                ></x-metadata-view>
            </div>
        </div>
        <div class="w-full h-full bg-background rounded-2xl shadow-xl">
            <iframe 
                src="https://s2.q4cdn.com/175719177/files/doc_presentations/Placeholder-PDF.pdf" 
                class="w-full h-full rounded-2xl" 
                frameborder="0"
            ></iframe>
        </div>
    </x-hero>
@endsection