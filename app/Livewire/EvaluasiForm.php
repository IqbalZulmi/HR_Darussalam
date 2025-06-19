<?php

namespace App\Livewire;

use App\Models\Evaluasi;
use App\Models\KategoriEvaluasi;
use App\Models\TahunAjaran;
use App\Models\User;
use Livewire\Component;

class EvaluasiForm extends Component
{
    public $id_pegawai ='';
    public $id_tahun_ajaran ='';
    public $dataNilaiEvaluasi;
    public $catatan = '';
    public $dataPegawai;
    public $dataTahunAjaran;
    public $dataKategori;

    public function mount(){
        $this->getDataPegawai();
        $this->getDataTahunAjaran();
        $this->getDataKategori();
    }

    public function updated($property)
    {
        if (in_array($property, ['id_pegawai', 'id_tahun_ajaran'])) {
            $this->loadEvaluasi();
        }
    }

    public function loadEvaluasi()
    {
        if ($this->id_pegawai && $this->id_tahun_ajaran) {
            $existing = Evaluasi::where('id_user', $this->id_pegawai)
                ->where('id_tahun_ajaran', $this->id_tahun_ajaran)
                ->get();

            $this->dataNilaiEvaluasi = $existing->pluck('nilai', 'id_kategori')->toArray();

            $this->catatan = $existing->first()->catatan ?? '';
        }
    }

    public function getDataPegawai()
    {
        $user = User::all();
        $this->dataPegawai = $user;
    }

    public function getDataTahunAjaran()
    {
        $tahunAjaran = TahunAjaran::where('is_aktif', true)->get();
        $this->dataTahunAjaran = $tahunAjaran;
    }

    public function getDataKategori()
    {
        $kategori = KategoriEvaluasi::orderBy('nama', 'asc')->get();
        $this->dataKategori = $kategori;
    }

    public function render()
    {
        return view('livewire.evaluasi-form');
    }
}
