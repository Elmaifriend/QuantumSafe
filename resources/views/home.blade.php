@extends('layouts.app')

@section('title', 'QuantumSafe')

@section('body')
    <x-hero>
        <div class="flex flex-col gap-1">
            <h1 class="text-display-medium md:text-display-large text-center text-highlight">QuantumSafe</h1>
            <h2 class="text-body-small text-foreground-tertiary text-center">Protege tu información hoy con QuantumSafe</h2>
            <h2 class="text-body-small text-foreground-tertiary text-center">Encriptación pensada para el mañana</h2>
        </div>
        <div class="bg-glass backdrop-blur-2xl shadow-xl rounded-2xl">
            @include('layouts.upload-form')
        </div>
    </x-hero>
@endsection
