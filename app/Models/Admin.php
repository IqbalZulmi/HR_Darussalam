<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_user',
        'id_tempat_bekerja',
        'nama',
        'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function cuti(){
        return $this->hasMany(Cuti::class,'id_admin');
    }

    public function evaluasi(){
        return $this->hasMany(Evaluasi::class,'id_admin');
    }

    public function pelatihanUmum(){
        return $this->hasMany(PelatihanUmum::class,'id_admin');
    }

    public function tempatBekerja()
    {
        return $this->belongsTo(TempatBekerja::class, 'id_tempat_bekerja');
    }
}
