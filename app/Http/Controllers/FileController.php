<?php

namespace App\Http\Controllers;

use App\Models\file;
use Illuminate\Http\Request;
use ParagonIE\Sodium\Compat;
use phpseclib3\Crypt\AES;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("files.index");
    }

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

        // 1. Generar clave AES aleatoria (shared_secret)
        $sharedSecret = random_bytes(32); // 256 bits para AES-256

        // 2. Encriptar el archivo con AES-GCM
        $file = $request->file('file');
        $cipher = new AES('gcm');
        $cipher->setKey($sharedSecret);
        $iv = random_bytes(16); // Nonce para GCM
        $cipher->setNonce($iv);
        $encryptedContent = $cipher->encrypt(file_get_contents($file->path()));

        // 3. Encriptar sharedSecret con X25519 (clave pública del usuario)
        $user = $request->user();
        $encryptedKey = Compat::crypto_box_seal(
            $sharedSecret,
            base64_decode($user->public_key)
        );

        // 4. Guardar archivo encriptado manualmente
        $storedName = uniqid() . '.enc';
        Storage::put("encrypted/{$storedName}", $encryptedContent); // aquí sí usas el contenido cifrado

        // 5. Guardar metadatos en DB
        File::create([
            'user_id' => $user->id,
            'original_name' => $file->getClientOriginalName(),
            'stored_name' => $storedName,
            'encrypted_key' => base64_encode($encryptedKey),
            'iv' => base64_encode($iv)
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
        $decryptedContent = $cipher->decrypt($encryptedContent);

        if ($decryptedContent === false) {
            return response()->json(['error' => 'Error al desencriptar el archivo'], 500);
        }

        // 4. Devolver el archivo desencriptado como descarga
        return response($decryptedContent)
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', 'attachment; filename="' . $file->original_name . '"');
    }

}
