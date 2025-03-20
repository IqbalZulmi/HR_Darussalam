<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    /** @use HasFactory<\Database\Factories\JabatanFactory> */
    use HasFactory;

    protected $table = 'jabatans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_jabatan',
    ];


    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_jabatan');
    }
}
