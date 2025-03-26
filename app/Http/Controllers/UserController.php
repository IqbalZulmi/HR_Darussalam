<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function updatePassword(Request $request){
        $validatedData = $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:8|different:password_lama',
            'konf_password' => 'required|same:password_baru',
        ], [
            'password_lama.required' => 'Masukkan password saat ini.',
            'password_baru.required' => 'Masukkan password baru.',
            'password_baru.min' => 'Password baru minimal terdiri dari 8 karakter.',
            'password_baru.different' => 'Password baru harus berbeda dengan password saat ini.',
            'konf_password.required' => 'Masukkan konfirmasi password baru.',
            'konf_password.same' => 'Konfirmasi password baru tidak cocok.',
        ]);

        if (!Hash::check($request->password_lama, Auth::user()->password)) {
            return redirect()->back()->withErrors(['password_lama' => 'Password salah.'])->withInput();
        }

        $user = User::where('id',Auth::user()->id)->firstOrFail();
        $user->password = Hash::make($request->password_baru);
        if ($user->save()) {
            return redirect()->back()->with([
                'notifikasi' => 'Password berhasil diperbarui!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'notifikasi' => 'Password gagal diperbarui!',
                'type' => 'error'
            ]);
        }
    }
}
