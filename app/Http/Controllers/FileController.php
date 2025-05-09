<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use ParagonIE\Sodium\Compat;
use phpseclib3\Crypt\AES;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['file' => 'required|file']);

        $sharedSecret = random_bytes(32);

        $file = $request->file('file');
        $cipher = new AES('gcm');
        $cipher->setKey($sharedSecret);
        $iv = random_bytes(16);
        $cipher->setNonce($iv);
        $encryptedContent = $cipher->encrypt(file_get_contents($file->path()));
        $authTag = $cipher->getTag();

        $user = $request->user();
        $encryptedKey = Compat::crypto_box_seal(
            $sharedSecret,
            base64_decode($user->public_key)
        );

        $storedName = uniqid() . '.enc';
        Storage::put("encrypted/{$storedName}", $encryptedContent);

        File::create([
            'user_id' => $user->id,
            'original_name' => $file->getClientOriginalName(),
            'stored_name' => $storedName,
            'encrypted_key' => base64_encode($encryptedKey),
            'iv' => base64_encode($iv),
            'auth_tag' => base64_encode($authTag),
        ]);

        return response()->json(['message' => 'Archivo encriptado y guardado']);
    }


    /**
     * Display the specified resource.
     */
    public function show(file $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(file $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, file $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(file $file)
    {
        //
    }

    public function download($id)
    {
        $user = request()->user();

        // 1. Buscar archivo
        $file = File::where('id', $id)
                    ->where('user_id', $user->id)
                    ->firstOrFail();

        // 2. Desencriptar la clave simétrica
        $encryptedKey = base64_decode($file->encrypted_key);
        $iv = base64_decode($file->iv);
        $authTag = base64_decode($file->auth_tag); // NUEVO

        //Asegúrate de tener la clave privada del usuario
        $privateKey = base64_decode($user->private_key); // debe estar protegida
        $publicKey = base64_decode($user->public_key);
        $keypair = $privateKey . $publicKey;

        $sharedSecret = Compat::crypto_box_seal_open(
            $encryptedKey,
            $keypair
        );

        if (!$sharedSecret) {
            return response()->json(['error' => 'No se pudo desencriptar la clave'], 403);
        }

        // 3. Leer y desencriptar el archivo
        $encryptedContent = Storage::get("encrypted/{$file->stored_name}");

        $cipher = new AES('gcm');
        $cipher->setKey($sharedSecret);
        $cipher->setNonce($iv);
        $cipher->setTag($authTag); // NUEVO
        $decryptedContent = $cipher->decrypt($encryptedContent);

        if ($decryptedContent === false) {
            return response()->json(['error' => 'Error al desencriptar el archivo'], 500);
        }

        // 4. Devolver el archivo desencriptado como descarga
        return response($decryptedContent)
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', 'attachment; filename="' . $file->original_name . '"');
    }

    public function index()
    {
        // Obtener los archivos del usuario autenticado
        $files = File::where('user_id', Auth::id())->latest()->get();

        return view('files.user-files', compact('files'));
    }

    public function upload(Request $request)
    {
        // Validar el archivo
        $request->validate([
            'newFile' => 'required|file|max:10240', // Máx 10MB
        ]);

        $user = Auth::user();

        // 1. Generar clave AES aleatoria (shared_secret)
        $sharedSecret = random_bytes(32);

        // 2. Encriptar el archivo con AES-GCM
        $cipher = new AES('gcm');
        $cipher->setKey($sharedSecret);
        $iv = random_bytes(16);
        $cipher->setNonce($iv);
        $encryptedContent = $cipher->encrypt(file_get_contents($request->file('newFile')->getRealPath()));
        $authTag = $cipher->getTag();

        // 3. Encriptar sharedSecret con X25519 (clave pública del usuario)
        $encryptedKey = Compat::crypto_box_seal(
            $sharedSecret,
            base64_decode($user->public_key)
        );

        // 4. Guardar archivo en el sistema de almacenamiento
        $storedName = uniqid() . '.enc';
        Storage::put("encrypted/{$storedName}", $encryptedContent);

        // 5. Guardar la información en la base de datos
        File::create([
            'user_id' => $user->id,
            'original_name' => $request->file('newFile')->getClientOriginalName(),
            'stored_name' => $storedName,
            'encrypted_key' => base64_encode($encryptedKey),
            'iv' => base64_encode($iv),
            'auth_tag' => base64_encode($authTag),
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('file.index')->with('message', 'Archivo subido exitosamente.');
    }

}
