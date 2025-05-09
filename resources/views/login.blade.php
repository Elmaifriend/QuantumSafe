@extends('layouts.app')

@section('title', 'QuantumSafe')

@section('body')
<div class="flex min-h-screen bg-[var(--color-background)] text-[var(--color-foreground)] font-sans">
    <!-- Imagen lateral -->
    <div class="flex w-1/2 items-center justify-center bg-cover bg-center rounded-r-[2rem]">
        <h1 class="text-white text-[var(--text-headline-large)] font-bold">QuantumSafe</h1>
    </div>


    <h1 class="text-white text-[var(--text-headline-large)] font-bold">QuantumSafe</h1>
    <!-- Formulario -->
    <div class="flex flex-col justify-center w-full md:w-1/2 p-8 md:p-20">
        <h2 class="text-3xl font-bold text-[#9c0e41] mb-6">Únete Ahora</h2>

        <form class="space-y-6" method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Nombre -->
            <div>
                <label class="block mb-1 text-[var(--color-foreground)] text-[var(--text-label-medium)] font-bold">Nombre*</label>
                <input type="text" name="name" placeholder="Tu nombre completo"
                    class="w-full border border-[var(--color-secondary)] rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[var(--color-highlight-light)]" />
            </div>

            <!-- Correo -->
            <div>
                <label class="block mb-1 text-[var(--color-foreground)] text-[var(--text-label-medium)] font-bold">Correo*</label>
                <input type="email" name="email" placeholder="tucorreo@ejemplo.com"
                    class="w-full border border-[var(--color-secondary)] rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[var(--color-highlight-light)]" />
            </div>

            <!-- Contraseña -->
            <div>
                <label class="block mb-1 text-[var(--color-foreground)] text-[var(--text-label-medium)] font-bold">Contraseña*</label>
                <div class="relative">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="************"
                        required
                        class="w-full border border-[var(--color-secondary)] rounded-full px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-[var(--color-highlight-light)]" />
                    <span role="button"
                        class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Botón principal -->
            <button type="submit"
                class="w-full bg-[var(--color-highlight)] text-white rounded-full py-2 font-bold hover:bg-[var(--color-highlight-dark)] transition">
                Entrar
            </button>

            <!-- Separador -->
            <div class="flex items-center justify-center text-[var(--color-foreground-tertiary)]">
                <hr class="flex-grow border-t border-[var(--color-tertiary)]" />
                <span class="mx-2 text-sm">o</span>
                <hr class="flex-grow border-t border-[var(--color-tertiary)]" />
            </div>

            <!-- Botón Google -->
            <button type="button"
                class="w-full bg-[var(--color-tertiary)] text-[var(--color-foreground)] rounded-full py-2 flex items-center justify-center gap-2 hover:bg-[var(--color-secondary)] transition">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5" />
                Iniciar sesión con Google
            </button>
        </form>
    </div>
</div>
</div>
@endsection