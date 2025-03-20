<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelatihanPegawai extends Model
{
    use HasFactory;

    protected $table = 'pelatihan_pegawai';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_pegawai',
        'id_pelatihan_umum',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function pelatihanUmum()
    {
        return $this->belongsTo(PelatihanUmum::class, 'id_pelatihan_umum');
    }
}
