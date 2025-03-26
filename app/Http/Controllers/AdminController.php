<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $admin = Auth::user();

        return view('admin.profile',[
            'dataProfile'=>$admin,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|unique:users,email,'. $request->old_email . ',email|email:dns',
            'nama' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'email.email' => 'Email tidak valid.',
            'email.email:dns' => 'Email tidak valid.',
            'nama.required' => 'Nama wajib diisi.',
            'foto.image' => 'Berkas foto harus berupa gambar.',
            'foto.mimes' => 'Format gambar yang diizinkan: jpeg, png, jpg.',
            'foto.max' => 'Ukuran gambar maksimum adalah 2 MB.',
        ]);

        try {
            DB::beginTransaction();

            $akun = User::where('id',Auth::user()->id)->firstOrFail();
            $akun->email = $request->email;

            $admin = admin::where('id_user',Auth::user()->id)->firstOrFail();
            $admin->nama = $request->nama;

            if ($request->hasFile('foto')) {
                $old_foto = $admin->foto;
                if (!empty($old_foto) && is_file('storage/'.$old_foto)) {
                    unlink('storage/'.$old_foto);
                }
                // Store the photo in the public/profile_img directory
                $foto = $request->file('foto')->store('profile_img','public');

                $foto = basename($foto);
                $admin->foto = $foto ? 'profile_img/' . $foto : null;
            }else{
                $foto = $admin->foto;
            }

            if($akun->isDirty() || $admin->isDirty()){
                $akun->save();
                $admin->save();
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
    public function destroy(admin $admin)
    {
        //
    }
}
