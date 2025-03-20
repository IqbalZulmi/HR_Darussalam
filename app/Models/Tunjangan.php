<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tunjangan extends Model
{
    /** @use HasFactory<\Database\Factories\TunjanganFactory> */
    use HasFactory;

    protected $table = 'tunjangan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_pegawai',
        'jumlah',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
}
