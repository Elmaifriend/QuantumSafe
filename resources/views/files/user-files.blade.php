<div class="w-screen h-screen flex flex-col items-center justify-center bg-gray-100 p-4">
    <div class="w-full max-w-4xl bg-white shadow-xl rounded-2xl p-6 overflow-auto">
        <h2 class="text-2xl font-bold mb-4">Tus archivos</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-6">
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

        <!-- Formulario para subir archivo -->
        <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="newFile">
            <button type="submit">Subir archivo</button>
        </form>

        @error('newFile') 
            <div class="text-red-500 mb-2 text-sm">{{ $message }}</div> 
        @enderror

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            Subir Archivo
        </button>

        @if (session()->has('message'))
            <div class="mt-4 text-green-600">
                {{ session('message') }}
            </div>
        @endif
    </div>
</div>
