<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    /** @use HasFactory<\Database\Factories\GolonganFactory> */
    use HasFactory;

    protected $table = 'golongans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_golongan',
    ];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_golongan');
    }
}
