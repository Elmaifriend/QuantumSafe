@extends('layouts.panel')

@section('title', 'QuantumSafe')

@section('body')
<div class="grid grid-cols-2 gap-8 p-2 min-h-screen bg-background text-foreground">
<!-- Formulario de registro -->
    <div class="flex flex-col justify-center w-full max-w-3xl justify-self-center">
        <h2 class="text-display-medium font-bold text-highlight mb-6">Crea tu cuenta</h2>

        {{-- Mostrar errores --}}
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('user.store') }}" class="space-y-6">
            @csrf

            <!-- Nombre -->
            <x-form-input
                label="Nombre"
                type="text"
                id="name"
                name="name"
                placeholder="Tu nombre completo"
                :required="true"
                value="{{ old('name') }}"
            ></x-form-input>

            <!-- Correo -->
            <x-form-input
                label="Correo Electrónico"
                type="email"
                id="email"
                name="email"
                placeholder="tucorreo@ejemplo.com"
                :required="true"
                value="{{ old('email') }}"
            ></x-form-input>

            <!-- Contraseña -->
            <x-form-input
                label="Contraseña"
                type="password"
                id="password"
                name="password"
                placeholder="************"
                :required="true"
            ></x-form-input>

            <!-- Confirmar contraseña -->
            <x-form-input
                label="Confirmar Contraseña"
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                placeholder="************"
                :required="true"
            ></x-form-input>

            <!-- Botón -->
            <x-button type="submit" class="w-full text-label-medium justify-center">Registrarse</x-button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-label-medium text-foreground-tertiary">
                ¿Ya tienes una cuenta?
                <a href="{{ route('login') }}" class="text-highlight font-medium hover:underline">Inicia sesión</a>
            </p>
        </div>
    </div>
    <!-- Imagen lateral -->
    <div class="relative bg-login-banner bg-cover bg-center rounded-2xl">
        <h1 class="absolute text-foreground-light text-headline-large bottom-1/4 text-shadow-2xl left-1/2 -translate-x-1/2">QuantumSafe</h1>
    </div>
</div>
@endsection
