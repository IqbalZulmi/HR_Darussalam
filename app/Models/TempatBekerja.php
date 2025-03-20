<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatBekerja extends Model
{
    use HasFactory;

    protected $table = 'tempat_bekerja';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_tempat_bekerja',
    ];

    public function admin()
    {
        return $this->hasMany(Admin::class, 'id_tempat_bekerja');
    }

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_tempat_bekerja');
    }
}
