<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gaji extends Model
{
    /** @use HasFactory<\Database\Factories\GajiFactory> */
    use HasFactory;

    protected $table = 'gaji';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_pegawai',
        'gaji_pokok',
        'bonus',
        'overtime',
        'potongan',
        'total_gaji',
        'tanggal_pembayaran',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
}

