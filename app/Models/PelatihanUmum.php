<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelatihanUmum extends Model
{
    use HasFactory;

    protected $table = 'pelatihan_umum';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_admin',
        'penyelenggara',
        'nama_pelatihan',
        'tanggal_pelatihan',
        'status',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }

    public function pelatihanPegawai(){
        return $this->hasMany(PelatihanPegawai::class,'id_pelatihan_umum');
    }

}
