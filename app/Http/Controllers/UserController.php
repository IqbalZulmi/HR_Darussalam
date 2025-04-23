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

       // Ambil semua permission dan kelompokkan berdasarkan prefix (modul)
        // Contoh: 'user.create' → 'user' => ['create', 'read', ...]
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->name)[0]; // Ambil prefix modul
        })->map(function ($groupedPermissions) {
            // Ambil hanya action-nya, misalnya dari 'user.create' → 'create'
            $actions = $groupedPermissions->map(function ($permission) {
                return explode('.', $permission->name)[1];
            });

            // Tentukan urutan preferensi
            $preferredOrder = ['create', 'read', 'update', 'delete'];

            // Urutkan berdasarkan urutan preferensi
            return collect($preferredOrder)->filter(function ($action) use ($actions) {
                return $actions->contains($action);
            })->values();
        });

        return view('roles-and-permissions.user-assign',[
            'users' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
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
