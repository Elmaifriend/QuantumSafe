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
            <div class="w-full px-6 py-6">
                <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="w-full p-6 border-2 rounded-lg text-center cursor-pointer transition">
                        <label for="newFile" class="block text-label-medium text-gray-600 cursor-pointer">
                            Arrastra y suelta archivos aquí o haz clic para seleccionar
                        </label>
                        <input type="file" name="newFile" id="newFile" class="hidden" />
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg">
                            Subir archivo
                        </button>
                    </div>
                </form>
            </div>

            <!-- Lista de archivos -->
            <div class="w-full px-6 pb-6">
                <h2 class="text-xl font-bold mb-4">Tus archivos</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @forelse ($files as $file)
                        <div class="p-4 border rounded-lg bg-gray-50">
                            <p class="font-semibold truncate">{{ $file->original_name }}</p>
                            <p class="text-sm text-gray-500 break-all">{{ $file->stored_name }}</p>
                            <a href="{{ route('files.download', $file->id) }}"
                               class="text-blue-600 hover:underline text-sm mt-2 inline-block">
                                Descargar
                            </a>
                        </div>
                    @empty
                        <p class="col-span-full text-gray-500">No tienes archivos aún.</p>
                    @endforelse
                </div>

                <!-- Mensajes -->
                @error('newFile') 
                    <div class="text-red-500 mt-4 text-sm">{{ $message }}</div> 
                @enderror

                @if (session()->has('message'))
                    <div class="mt-4 text-green-600">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
