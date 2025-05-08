<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PengajuanCutiController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSosialMediaController;
use App\Http\Controllers\VerifikasiCutiController;
use App\Models\PengajuanCuti;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginPage'])->name('login.page');
    Route::post('/proses-login', [AuthController::class, 'loginProcess'])->name('login.process');
});

Route::middleware(['auth'])->group(function () {

    //roles route
    Route::prefix('role')->name('role.')->group(function(){
        Route::get('/',[RolesController::class,'index'])->middleware('Check_Roles_or_Permissions:manajemen_role.read')
        ->name('index');
        Route::post('/',[RolesController::class,'store'])->middleware('Check_Roles_or_Permissions:manajemen_role.create')
        ->name('store');
        Route::put('/{id_role}',[RolesController::class,'update'])->middleware('Check_Roles_or_Permissions:manajemen_role.update')
        ->name('update');
        Route::delete('/{id_role}',[RolesController::class,'destroy'])->middleware('Check_Roles_or_Permissions:manajemen_role.destroy')
        ->name('destroy');
    });

    //permission route
    Route::prefix('permission')->name('permission.')->group(function(){
        Route::get('/',[PermissionController::class,'index'])->middleware('Check_Roles_or_Permissions:manajemen_hak_akses.read')
        ->name('index');
        Route::post('/',[PermissionController::class,'store'])->middleware('Check_Roles_or_Permissions:manajemen_hak_akses.create')
        ->name('store');
        Route::put('/{id_permission}',[PermissionController::class,'update'])->middleware('Check_Roles_or_Permissions:manajemen_hak_akses.update')
        ->name('update');
        Route::delete('/mass-delete',[PermissionController::class,'destroy'])->middleware('Check_Roles_or_Permissions:manajemen_hak_akses.delete')
        ->name('destroy');
    });

    //user assign route
    Route::prefix('users')->name('user.assign.')->group(function(){
        Route::get('assign', [UserController::class, 'assignIndex'])->middleware('Check_Roles_or_Permissions:manajemen_hak_akses_user.read')
        ->name('index');

        Route::middleware('Check_Roles_or_Permissions:manajemen_hak_akses_user.update')->group(function () {
            Route::put('{id}/assign-roles', [UserController::class, 'assignRoles'])
            ->name('roles.update');
            Route::put('{id}/assign-permisson', [UserController::class, 'assignPermission'])
            ->name('permissions.update');
        });
    });

    // Profile routes
    Route::prefix('profile')->name('profile.')->group(function(){
        Route::get('/', [ProfileController::class, 'showProfilePage'])->middleware('Check_Roles_or_Permissions:manajemen_profil.read')
        ->name('page');
        Route::middleware('Check_Roles_or_Permissions:manajemen_profil.update')->group(function(){
            Route::put('/update', [ProfileController::class, 'update'])->middleware('Check_Roles_or_Permissions:manajemen_profil.update')
            ->name('update');
            Route::put('/change-password',([UserController::class,'updatePassword']))->middleware('Check_Roles_or_Permissions:manajemen_profil.update')
            ->name('password.update');
        });
    });

    //keluarga routes
    Route::prefix('keluarga/')->name('keluarga.')->group(function(){
        Route::delete('/{id_keluarga}/delete',[KeluargaController::class,'destroy'])->middleware('Check_Roles_or_Permissions:manajemen_profil.delete')
        ->name('destroy');
    });

    //user sosial medit routes
    Route::prefix('user/sosmed')->name('user.sosmed.')->group(function(){
        Route::delete('/{id_user_sosmed}/delete',[UserSosialMediaController::class,'destroy'])->middleware('Check_Roles_or_Permissions:manajemen_profil.delete')
        ->name('destroy');
    });

    // Kelola Pegawai routes
    Route::prefix('kelola/pegawai')->name('kelola.pegawai.')->group(function(){
        Route::get('/',[UserController::class,'showKelolaPegawaiPage'])
        ->name('page');

        Route::get('/{id_pegawai}/profile',[UserController::class,'showEditPegawaiPage'])
        ->name('edit.page');

        Route::get('/{id_pegawai}/rekap-absen',[AbsensiController::class,'edit'])
        ->name('rekap.absen.page');

        Route::post('/',[UserController::class,'tambahPegawai'])->middleware('Check_Roles_or_Permissions:manajemen_user.create')
        ->name('store');

        Route::put('/{id_pegawai}',[UserController::class,'updatePegawaiProfile'])
        ->name('update');

        Route::put('/{id_pegawai}/password',([UserController::class,'updatePasswordPegawai']))
        ->name('password.update');

        Route::delete('/kelola/mass-delete/pegawai', [UserController::class, 'hapusMassalPegawai'])
        ->name('mass.delete');
    });

    //pengajuan cuti routes
    Route::prefix('pengajuan/cuti')->name('pengajuan.cuti.')->group(function(){
        //halaman Tenaga pendidik
        Route::get('/tendik', [PengajuanCutiController::class, 'showPengajuanCutiTendikPage'])
        ->name('tendik.page');

        Route::post('/tendik/store', [PengajuanCutiController::class, 'storePengajuanTendik'])
        ->name('tendik.store');

        //halaman Kepala sekolah dan kepala departemen
        Route::get('/kepsek', [PengajuanCutiController::class, 'showPengajuanCutiKepsekPage'])
        ->name('kepsek.page');

        Route::post('/kepsek/store', [PengajuanCutiController::class, 'storePengajuanKepsek'])
        ->name('kepsek.store');

        //halaman staff hrd
        Route::get('/staff-hrd', [PengajuanCutiController::class, 'showPengajuanCutiStaffHrdPage'])
        ->name('staff.hrd.page');

        Route::post('/staff-hrd/store', [PengajuanCutiController::class, 'storePengajuanStaffHrd'])
        ->name('staff.hrd.store');
    });

    // verifikasi cuti routes
    Route::prefix('verifikasi-cuti')->name('verifikasi.cuti.')->group(function(){
        //halaman kepsek
        Route::get('/kepsek', [VerifikasiCutiController::class, 'showVerifikasiKepsekPage'])
        ->name('kepsek.page');

        Route::put('{id_pengajuan}/kepsek', [VerifikasiCutiController::class, 'verifikasiCutiKepsek'])
        ->name('kepsek.update');

        //halaman dirpen
        Route::get('/dirpen', [VerifikasiCutiController::class, 'showVerifikasiDirpenPage'])
        ->name('dirpen.page');

        Route::put('{id_pengajuan}/dirpen', [VerifikasiCutiController::class, 'verifikasiCutiDirpen'])
        ->name('dirpen.update');

        //halaman staff hrd
        Route::get('/staff-hrd', [VerifikasiCutiController::class, 'showVerifikasiHrdPage'])
        ->name('hrd.page');

        Route::put('{id_pengajuan}/staff-hrd', [VerifikasiCutiController::class, 'verifikasiCutiHrd'])
        ->name('hrd.update');

        //halaman kepala hrd
        Route::get('/kepala-hrd', [VerifikasiCutiController::class, 'showVerifikasiKepalaHrdPage'])
        ->name('kepala.hrd.page');

        Route::put('{id_pengajuan}/kepala-hrd', [VerifikasiCutiController::class, 'verifikasiCutiKepalaHrd'])
        ->name('kepala.hrd.update');

    });

     //rekap absensi routes
    Route::prefix('rekap/absensi')->name('rekap.absensi.')->group(function(){
        Route::get('/hari-ini', [AbsensiController::class, 'showRekapTodayPage'])->middleware('Check_Roles_or_Permissions:manajemen_rekap_absensi.read')
        ->name('today.page');
        Route::get('/pribadi', [AbsensiController::class, 'showRekapPribadiPage'])
        ->name('pribadi.page');
    });

    //HRD pages
    Route::prefix('hrd')->name('hrd.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'showAdminDashboard'])->name('dashboard.page');
    });

    //pegawai pages
    Route::prefix('pegawai')->name('pegawai.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'showPegawaiDashboard'])->name('dashboard.page');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
