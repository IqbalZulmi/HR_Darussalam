<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\TempatBekerja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawai = Pegawai::where('id_tempat_bekerja',Auth::user()->admin->id_tempat_bekerja)->get();
        $jabatan = Jabatan::all();
        $tempat_bekerja = TempatBekerja::all();
        $golongan = Golongan::all();

        return view('admin.kelola-pegawai',[
            'dataPegawai' => $pegawai,
            'dataJabatan' => $jabatan,
            'dataTempatBekerja' => $tempat_bekerja,
            'dataGolongan' => $golongan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

    }

    public function showProfile()
    {
        $pegawai = Auth::user();

        return view('pegawai.profile',[
            'dataProfile'=>$pegawai,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id_user)
    {
        $validatedData = $request->validate([
            'email' => 'required|unique:users,email,'. $request->old_email . ',email|email:dns',
            'password' => 'nullable|min:8',
            'id_tempat_bekerja' => 'required|exists:tempat_bekerja,id',
            'id_jabatan' => 'required|exists:jabatans,id',
            'id_golongan' => 'required|exists:golongans,id',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telepon' => 'required|regex:/^[0-9]+$/|min:10|max:15',
            'tanggal_lahir' => 'required|date',
            'tanggal_masuk' => 'required|date',
            'gender' => 'required|in:pria,wanita',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'email.email' => 'Email tidak valid.',
            'id_tempat_bekerja.required' => 'Tempat bekerja wajib dipilih.',
            'id_tempat_bekerja.exists' => 'Tempat bekerja tidak valid.',
            'id_jabatan.required' => 'Jabatan wajib dipilih.',
            'id_jabatan.exists' => 'Jabatan tidak valid.',
            'id_golongan.required' => 'Golongan wajib dipilih.',
            'id_golongan.exists' => 'Golongan tidak valid.',
            'nama.required' => 'Nama wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'no_telepon.required' => 'Nomor telepon wajib diisi.',
            'no_telepon.regex' => 'Nomor telepon hanya boleh berisi angka.',
            'no_telepon.min' => 'Nomor telepon minimal 10 digit.',
            'no_telepon.max' => 'Nomor telepon maksimal 15 digit.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'tanggal_masuk.required' => 'Tanggal masuk wajib diisi.',
            'tanggal_masuk.date' => 'Format tanggal masuk tidak valid.',
            'gender.required' => 'Jenis kelamin wajib dipilih.',
            'gender.in' => 'Jenis kelamin harus pria atau wanita.',
            'foto.image' => 'Berkas foto harus berupa gambar.',
            'foto.mimes' => 'Format gambar yang diizinkan: jpeg, png, jpg.',
            'foto.max' => 'Ukuran gambar maksimum adalah 2 MB.',
        ]);

        try {
                DB::beginTransaction();

                $akun = User::findOrFail($id_user);
                $akun->email = $request->email;

                if ($request->filled('password')) {
                    $akun->password = Hash::make($request->password);
                }

                $pegawai = Pegawai::where('id_user', $id_user)->firstOrFail();
                $pegawai->nama = $request->nama;
                $pegawai->alamat = $request->alamat;
                $pegawai->no_telepon = $request->no_telepon;
                $pegawai->tanggal_lahir = $request->tanggal_lahir;
                $pegawai->tanggal_masuk = $request->tanggal_masuk;
                $pegawai->gender = $request->gender;
                $pegawai->id_tempat_bekerja = $request->id_tempat_bekerja;
                $pegawai->id_jabatan = $request->id_jabatan;
                $pegawai->id_golongan = $request->id_golongan;

                if ($request->hasFile('foto')) {
                    $old_foto = $pegawai->foto;
                    if (!empty($old_foto) && is_file('storage/'.$old_foto)) {
                        unlink('storage/'.$old_foto);
                    }
                    // Store the photo in the public/profile_img directory
                    $foto = $request->file('foto')->store('profile_img','public');

                    $foto = basename($foto);
                    $pegawai->foto = $foto ? 'profile_img/' . $foto : null;
                }else{
                    $foto = $pegawai->foto;
                }

                if($akun->isDirty() || $pegawai->isDirty()){
                    $akun->save();
                    $pegawai->save();
                    DB::commit();

                    return redirect()->back()->with([
                        'notifikasi' => 'Berhasil mengubah data',
                        'type' => 'success',
                    ]);
                }else{
                    return redirect()->back()->with([
                        'notifikasi' => 'tidak ada data',
                        'type' => 'info',
                    ]);
                }

            } catch (\Exception $e) {

                DB::rollback();

                return redirect()->back()->with([
                    'notifikasi' => 'Gagal mengubah data' ,
                    'type' => 'error',
                ]);
            }
    }

    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
        'email' => 'required|unique:users,email,'. $request->old_email . ',email|email:dns',
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string',
        'no_telepon' => 'required|regex:/^[0-9]+$/|min:10|max:15',
        'tanggal_lahir' => 'required|date',
        'gender' => 'required|in:pria,wanita',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ], [
        'email.required' => 'Email wajib diisi.',
        'email.unique' => 'Email sudah digunakan.',
        'email.email' => 'Email tidak valid.',
        'nama.required' => 'Nama wajib diisi.',
        'foto.image' => 'Berkas foto harus berupa gambar.',
        'foto.mimes' => 'Format gambar yang diizinkan: jpeg, png, jpg.',
        'foto.max' => 'Ukuran gambar maksimum adalah 2 MB.',
        'no_telepon.regex' => 'Nomor telepon hanya boleh berisi angka.',
        'no_telepon.min' => 'Nomor telepon minimal 10 digit.',
        'no_telepon.max' => 'Nomor telepon maksimal 15 digit.',
        'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
        'gender.in' => 'Jenis kelamin harus pria atau wanita.',
    ]);

    try {
        DB::beginTransaction();

        $akun = User::findOrFail(Auth::user()->id);
        $akun->email = $request->email;

        $pegawai = Pegawai::where('id_user', Auth::user()->id)->firstOrFail();
        $pegawai->nama = $request->nama;
        $pegawai->alamat = $request->alamat;
        $pegawai->no_telepon = $request->no_telepon;
        $pegawai->tanggal_lahir = $request->tanggal_lahir;
        $pegawai->gender = $request->gender;

            if ($request->hasFile('foto')) {
                $old_foto = $pegawai->foto;
                if (!empty($old_foto) && is_file('storage/'.$old_foto)) {
                    unlink('storage/'.$old_foto);
                }
                // Store the photo in the public/profile_img directory
                $foto = $request->file('foto')->store('profile_img','public');

                $foto = basename($foto);
                $pegawai->foto = $foto ? 'profile_img/' . $foto : null;
            }else{
                $foto = $pegawai->foto;
            }

            if($akun->isDirty() || $pegawai->isDirty()){
                $akun->save();
                $pegawai->save();
                DB::commit();

                return redirect()->back()->with([
                    'notifikasi' => 'Berhasil mengubah profile',
                    'type' => 'success',
                ]);
            }else{
                return redirect()->back()->with([
                    'notifikasi' => 'tidak ada perubahan',
                    'type' => 'info',
                ]);
            }

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->back()->with([
                'notifikasi' => 'Gagal mengubah profile' ,
                'type' => 'error',
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        //
    }
}
