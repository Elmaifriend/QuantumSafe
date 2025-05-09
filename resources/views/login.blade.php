@extends('layouts.panel')

@section('title', 'QuantumSafe')

@section('body')
<div class="grid grid-cols-2 gap-8 p-2 min-h-screen bg-background text-foreground">
    <!-- Imagen lateral -->
    <div class="relative bg-login-banner bg-cover bg-center rounded-2xl">
        <h1 class="absolute text-foreground-light text-headline-large bottom-1/4 text-shadow-2xl left-1/2 -translate-x-1/2">QuantumSafe</h1>
    </div>

    <!-- Formulario -->
    <div class="flex flex-col justify-center w-full max-w-3xl justify-self-center">
        <h2 class="text-display-medium font-bold text-highlight mb-6">Únete Ahora</h2>

        {{-- Mostrar errores generales --}}
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form class="space-y-6" method="POST" action="{{ route('user.authenticate') }}">
            @csrf

            <!-- Correo -->
            <x-form-input
                label="Email"
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

            <!-- Botón principal -->
            <x-button type="submit" class="w-full text-label-medium justify-center">Entrar</x-button>

            <!-- Separador -->
            <div class="flex items-center justify-center text-foreground-tertiary">
                <hr class="flex-grow border-t border-tertiary" />
                <span class="mx-2 text-sm">o</span>
                <hr class="flex-grow border-t border-tertiary" />
            </div>

            <!-- Botón Google -->
            <x-button class="bg-tertiary text-label-medium w-full justify-center text-foreground-tertiary hover:bg-secondary gap-2 font-bold">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5" />
                Iniciar sesión con Google
            </x-button>
        </form>
    </div>
</div>
@endsection
