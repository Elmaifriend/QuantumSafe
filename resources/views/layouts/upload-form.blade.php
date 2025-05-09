<form method="POST" enctype="multipart/form-data"
    class="w-full max-w-xl px-4 py-8 flex flex-col gap-4 items-center justify-center">
    @csrf

    <div class="flex flex-col gap-1 items-center text-foreground-tertiary">
        <i class="bx bxs-cloud-upload !text-[80px]"></i>
        <span class="text-label-large">Sube un Archivo</span>
    </div>

    <x-form-input class="text-label-medium text-foreground-tertiary text-center" label="" id="file"
        type="file"></x-form-input>

    <p class="text-label-medium text-foreground-secondary">Tamaño máximo: 2MB</p>

    <x-button type="submit" class="text-label-medium font-bold">
        <span>Subir y Cifrar</span>
        <x-bx-arrow-up-right></x-bx-arrow-up-right>
    </x-button>
</form>
