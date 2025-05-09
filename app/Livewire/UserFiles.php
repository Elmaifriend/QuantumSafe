<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use ParagonIE\Sodium\Compat;
use phpseclib3\Crypt\AES;

class UserFiles extends Component
{
    use WithFileUploads;

    public $files = [];
    public $newFile;

    protected $rules = [
        'newFile' => 'required|file|max:10240', // 10MB
    ];

    public function mount()
    {
        $this->loadFiles();
    }

    public function loadFiles()
    {
        $this->files = File::where('user_id', Auth::id())->latest()->get();
    }

    /* public function uploadFile()
    {
        $this->validate();

        $user = Auth::user();

        // Paso 1: generar clave AES
        $sharedSecret = random_bytes(32);

        // Paso 2: encriptar el contenido
        $cipher = new AES('gcm');
        $cipher->setKey($sharedSecret);
        $iv = random_bytes(16);
        $cipher->setNonce($iv);
        $encryptedContent = $cipher->encrypt(file_get_contents($this->newFile->getRealPath()));

        // Paso 3: encriptar clave con clave pública del usuario
        $encryptedKey = Compat::crypto_box_seal(
            $sharedSecret,
            base64_decode($user->public_key)
        );

        // Paso 4: guardar archivo en disco local
        $storedName = uniqid() . '.enc';
        Storage::put("encrypted/{$storedName}", $encryptedContent);

        // Paso 5: guardar en base de datos
        File::create([
            'user_id' => $user->id,
            'original_name' => $this->newFile->getClientOriginalName(),
            'stored_name' => $storedName,
            'encrypted_key' => base64_encode($encryptedKey),
            'iv' => base64_encode($iv)
        ]);

        $this->reset('newFile');
        $this->loadFiles();

        session()->flash('message', 'Archivo subido exitosamente.');
    } */

    public function uploadFile()
{
    // Validar el archivo
    $this->validate();

    // Guardar el archivo en el disco (configurado en config/filesystems.php)
    $path = $this->newFile->store('files');  // El archivo se guarda en el directorio 'files'

    // Puedes guardar en la base de datos la información relacionada con el archivo (si es necesario)
    File::create([
        'user_id' => Auth::id(),
        'original_name' => $this->newFile->getClientOriginalName(),
        'stored_name' => $path,
    ]);

    // Resetear la propiedad de archivo
    $this->reset('newFile');

    // Cargar los archivos para mostrar en la interfaz
    $this->loadFiles();

    // Mostrar mensaje de éxito
    session()->flash('message', 'Archivo subido exitosamente.');
}

    public function render()
    {
        return view('livewire.user-files');
    }
}
