@extends('layouts.app')

@section('title', 'QuantumSafe')

@section('body')
    <x-hero>
        <div class="bg-glass backdrop-blur-2xl shadow-xl rounded-2xl">
            @include('layouts.upload-form')
        </div>
    </x-hero>
@endsection