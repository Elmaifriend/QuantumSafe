<div
    class="w-screen h-screen flex flex-col items-center justify-center bg-gray-100 p-4"
    x-data="{
        dragOver: false,
        triggerInput() { $refs.fileInput.click(); },
        handleDrop(event) {
            const files = event.dataTransfer.files;
            $refs.fileInput.files = files;
            $refs.fileInput.dispatchEvent(new Event('change', { bubbles: true }));
        }
    }"
    @dragover.prevent="dragOver = true"
    @dragleave.prevent="dragOver = false"
    @drop.prevent="handleDrop($event); dragOver = false"
>
    <div class="w-full max-w-4xl bg-white shadow-xl rounded-2xl p-6 overflow-auto">
        <h2 class="text-2xl font-bold mb-4">Tus archivos</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-6">
            @forelse ($files as $file)
                <div class="p-4 border rounded-lg bg-gray-50">
                    <p class="font-semibold truncate">{{ $file->original_name }}</p>
                    <p class="text-sm text-gray-500 break-all">{{ $file->stored_name }}</p>
                </div>
            @empty
                <p class="col-span-full text-gray-500">No tienes archivos aún.</p>
            @endforelse
        </div>

        <form wire:submit.prevent="uploadFile"
            class="border-4 border-dashed rounded-xl h-40 flex items-center justify-center relative mb-4"
            :class="dragOver ? 'border-blue-500 bg-blue-50' : 'border-gray-300'">

            <label class="cursor-pointer absolute inset-0 flex items-center justify-center text-gray-400 hover:text-blue-600"
                   @click="triggerInput">
                <span>Arrastra un archivo aquí o haz clic para subir</span>
                <input type="file" class="hidden" wire:model="newFile" x-ref="fileInput" />
            </label>
        </form>

        @error('newFile') 
            <div class="text-red-500 mb-2 text-sm">{{ $message }}</div> 
        @enderror

        <button wire:click="uploadFile"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            Subir Archivo
        </button>

        @if (session()->has('message'))
            <div class="mt-4 text-green-600">
                {{ session('message') }}
            </div>
        @endif
    </div>
</div>
