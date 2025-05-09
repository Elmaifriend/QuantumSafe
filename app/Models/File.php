<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /** @use HasFactory<\Database\Factories\FileFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'original_name',
        'stored_name',
        'encrypted_key',
        'iv',
        'auth_tag'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
