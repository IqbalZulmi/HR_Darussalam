<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    /** @use HasFactory<\Database\Factories\PegawaiFactory> */
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_user',
        'id_tempat_bekerja',
        'id_jabatan',
        'id_golongan',
        'nama',
        'alamat',
        'no_telepon',
        'tanggal_lahir',
        'gender',
        'foto',
        'tanggal_masuk',
    ];

    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }

    public function gaji(){
        return $this->hasMany(Gaji::class,'id_pegawai');
    }

    public function tunjangan(){
        return $this->hasMany(Tunjangan::class,'id_pegawai');
    }

    public function absensi(){
        return $this->hasMany(Absensi::class,'id_pegawai');
    }

    public function cuti(){
        return $this->hasMany(Cuti::class,'id_pegawai');
    }

    public function evaluasi(){
        return $this->hasMany(Evaluasi::class,'id_pegawai');
    }

    public function pelatihanPegawai(){
        return $this->hasMany(PelatihanPegawai::class,'id_pegawai');
    }

    public function tempatBekerja()
    {
        return $this->belongsTo(TempatBekerja::class, 'id_tempat_bekerja');
    }

    public function jabatan()
    {
        return $this->belongsTo(TempatBekerja::class, 'id_jabatan');
    }

    public function golongan()
    {
        return $this->belongsTo(TempatBekerja::class, 'id_golongan');
    }
}
