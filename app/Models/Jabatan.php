<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    /** @use HasFactory<\Database\Factories\JabatanFactory> */
    use HasFactory;

    protected $fillable = [
        'nama_jabatan',
    ];

    public function profile(){
        return $this->hasMany(Profile::class,'id_jabatan');
    }
}
