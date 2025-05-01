<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    /** @use HasFactory<\Database\Factories\EvaluasiFactory> */
    use HasFactory;

    protected $table = 'evaluasis';

    // Kolom yang dapat diisi massal
    protected $fillable = [
        'id_user',
        'nilai',
        'komentar',
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
