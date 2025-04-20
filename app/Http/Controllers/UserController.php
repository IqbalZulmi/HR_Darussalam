<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

    public function assignIndex(){
        $user = User::all();
        $roles = Role::all();

        $action = ['create', 'read', 'update', 'delete'];

        // Ambil semua permission dan kelompokkan berdasarkan nama modul (prefix sebelum titik)
        // $permissions: Collection (Grouped) -> Semua permissions, dikelompokkan berdasarkan modul (prefix)
        $permissions = Permission::all()->groupBy(function($permission) {
            return explode('.', $permission->name)[0]; // contoh: 'user.create' → 'user'
        });

        // Ambil nama-nama modul dari key hasil groupBy
        // $nama_permission: Collection -> List nama modul
        $nama_permission = $permissions->keys();

        // dd($permissions);

        return view('user-assign',[
            'users' => $user,
            'roles' => $roles,
            'nama_permissions' => $nama_permission,
            'actions' => $action,
        ]);
    }

    public function assignPermission(Request $request, $id_user) {
        $validate = $request->validate([
            'permissions' => 'array',
        ]);

        try {
            // Mencari user berdasarkan ID
            $user = User::findOrFail($id_user);

            // Menyinkronkan permissions dengan user
            $user->syncPermissions($request->permissions);

            return redirect()->back()->with([
                'notifikasi' => 'Permission berhasil ditambahkan ke user',
                'type' => 'success'
            ]);
        } catch (\Exception $e) {  // Menangkap exception
            // Menangani error jika terjadi
            return redirect()->back()->with([
                'notifikasi' => 'Permission gagal ditambahkan ke user: ' . $e->getMessage(),
                'type' => 'error'
            ]);
        }
    }

    public function assignRoles(Request $request, $id_user) {
        $validate = $request->validate([
            'roles' => 'array',
        ]);

        try {
            // Mencari user berdasarkan ID
            $user = User::findOrFail($id_user);

            // Menyinkronkan role dengan user
            $user->syncRoles($request->roles);

            return redirect()->back()->with([
                'notifikasi' => 'Role berhasil ditambahkan ke user',
                'type' => 'success'
            ]);
        } catch (\Exception $e) {  // Menangkap exception
            // Menangani error jika terjadi
            return redirect()->back()->with([
                'notifikasi' => 'Role gagal ditambahkan ke user: ' . $e->getMessage(),
                'type' => 'error'
            ]);
        }
    }
}
