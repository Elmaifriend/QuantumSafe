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
        'newFile' => 'required|file|max:10240', // Máx 10MB
    ];

    public function mount()
    {
        $this->loadFiles();
    }

    public function loadFiles()
    {
        $this->files = File::where('user_id', Auth::id())->latest()->get();
    }

    public function uploadFile()
    {
        $this->validate();

        $user = Auth::user();

        // 1. Generar clave AES aleatoria (shared_secret)
        $sharedSecret = random_bytes(32);

        // 2. Encriptar el archivo con AES-GCM
        $cipher = new AES('gcm');
        $cipher->setKey($sharedSecret);
        $iv = random_bytes(16);
        $cipher->setNonce($iv);
        $encryptedContent = $cipher->encrypt(file_get_contents($this->newFile->getRealPath()));

        // 3. Encriptar sharedSecret con X25519 (clave pública del usuario)
        $encryptedKey = Compat::crypto_box_seal(
            $sharedSecret,
            base64_decode($user->public_key)
        );

        // 4. Guardar archivo
        $storedName = uniqid() . '.enc';
        Storage::put("encrypted/{$storedName}", $encryptedContent);

        // 5. Guardar en base de datos
        File::create([
            'user_id' => $user->id,
            'original_name' => $this->newFile->getClientOriginalName(),
            'stored_name' => $storedName,
            'encrypted_key' => base64_encode($encryptedKey),
            'iv' => base64_encode($iv)
        ]);

        $this->newFile = null;
        $this->loadFiles();

        session()->flash('message', 'Archivo subido exitosamente.');
    }

    public function render()
    {
        return view('livewire.user-files');
    }
}
