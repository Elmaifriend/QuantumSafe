@extends('layouts.panel')

@section('title', 'QuantumSafe')

@section('body')
    <div class="grid h-svh grid-cols-[250px_1fr] p-2">
        <!-- Panel lateral -->
        <div class="w-full h-full grid grid-rows-[auto_1fr_auto] p-4 gap-8">
            <a href="{{ route('home') }}" class="flex gap-1 items-center">
                <img class="w-[60px]" src="{{ Vite::asset('resources/images/logo.png') }}" alt="QuantumSafe Logo">
                <h1 class="text-body-small font-bold">QuantumSafe</h1>
            </a>
            <div class="flex flex-col gap-2">
                <x-panel-button name="Inicio" icon="bx-home-alt" />
                <x-panel-button name="Archivos" icon="bx-folder" />
                <x-panel-button name="Archivos Privados" icon="bx-lock" />
                <x-panel-button name="Compartidos" icon="bx-share-alt" />
                <x-panel-button name="Eliminados" icon="bx-trash" />
                <x-panel-button name="Configuración" icon="bx-cog" />
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

        <!-- Panel derecho -->
        <div class="w-full h-full bg-white rounded-2xl border border-tertiary overflow-y-auto">
            <!-- Área de subida -->
            <div class="w-fullpy-6">
                <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2">
                    @csrf
                    <div class="w-full p-6 rounded-lg text-center cursor-pointer transition">
                        <x-form-input
                             label="Arrastra tus archivos aqui"
                             id="newFile"
                             type="file"
                             :required="true"
                        ></x-form-input>
                    </div>

                    <div class="self-end">
                        <x-button type="submit" class="text-label-medium">
                            Subir archivo
                        </x-button>
                    </div>
                </form>
            </div>

            <!-- Lista de archivos -->
            <div class="w-full px-6 pb-6">
                <h2 class="text-xl font-bold mb-4">Tus archivos</h2>
                <div class="flex flex-wrap gap-4">
                    @forelse ($files as $file)
                        <x-file
                            file="{{ $file->original_name }}"
                            storedName="{{ $file->stored_name }}"
                            fileId="{{ $file->id }}"
                        ></x-file>
                    @empty
                        <p class="col-span-full text-foreground-tertiary">No tienes archivos aún.</p>
                    @endforelse
                </div>

                <!-- Mensajes -->
                @error('newFile') 
                    <div class="text-red-500 mt-4 text-sm">{{ $message }}</div> 
                @enderror

                @if (session()->has('message'))
                    <div class="mt-4 text-highlight">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
