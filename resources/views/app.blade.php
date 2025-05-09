@extends('layouts.panel')

@section('title', 'QuantumSafe')

@section('body')
    <div class="grid h-svh grid-cols-[250px_1fr] p-2">
        <div class="w-full h-full grid grid-rows-[auto_1fr_auto] p-4 gap-8">
            <a href="{{ route('home') }}" class="flex gap-1 items-center">
                <img class="w-[60px]" src="{{ Vite::asset('resources/images/logo.png') }}" alt="QuantumSafe Logo">
                <h1 class="text-body-small font-bold">QuantumSafe</h1>
            </a>
            <div class="flex flex-col gap-2">
                <x-panel-button
                    name="Inicio"
                    icon="bx-home-alt"
                ></x-panel-button>
                <x-panel-button
                    name="Archivos"
                    icon="bx-folder"
                ></x-panel-button>
                <x-panel-button
                    name="Archivos Privados"
                    icon="bx-lock"
                ></x-panel-button>
                <x-panel-button
                    name="Compartidos"
                    icon="bx-share-alt"
                ></x-panel-button>
                <x-panel-button
                    name="Eliminados"
                    icon="bx-trash"
                ></x-panel-button>
                <x-panel-button
                    name="Configuración"
                    icon="bx-cog"
                ></x-panel-button>
            </div>
            <div class="p-2 flex flex-col gap-3">
                <p class="text-label-large">Almacenamiento</p>
                <div class="flex flex-col gap-2">
                    <div class="w-full h-[2px] rounded-full bg-secondary">
                        <div class="w-1/3 rounded-full bg-highlight h-full"></div>
                    </div>
                    <p class="text-label-small">13.2 GB de 16 GB usados</p>
                </div>
            </div>
        </div>
        <div class="w-full h-full bg-white rounded-2xl border border-tertiary">
            <div class="w-full flex justify-end px-4 py-6">
                <x-button href="#" class="text-label-medium font-bold">
                    <span>Subir Archivo</span>
                    <x-bx-arrow-up-right></x-bx-arrow-up-right>
                </x-button>
            </div>
            <x-panel-files :files="[
                'archivo.pdf',
                'imagen.png'
            ]"></x-panel-files>
        </div>
    </div>
</div>

@endsection