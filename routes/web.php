<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
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
        Route::get('/', [AdminController::class, 'show'])->middleware('Check_Roles_or_Permissions:manajemen_profil.read')
        ->name('page');
        Route::middleware('Check_Roles_or_Permissions:manajemen_profil.update')->group(function(){
            Route::put('/update', [AdminController::class, 'update'])
            ->name('update');
            Route::put('/change-password',([UserController::class,'updatePassword']))
            ->name('password.update');
        });
    });

    //HRD pages
    Route::prefix('hrd')->name('hrd.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'showAdminDashboard'])->name('dashboard.page');

        //rekap absensi route
        Route::prefix('rekap/absensi')->name('rekap.absensi.')->group(function(){
            Route::get('/hari-ini', [AbsensiController::class, 'showRekapTodayPage'])->middleware('Check_Roles_or_Permissions:manajemen_rekap_absensi.read')
            ->name('today.page');
        });

        //verifikasi cuti route
        Route::prefix('verifikasi-cuti')->name('verifikasi.cuti.')->group(function(){
            Route::get('/', [CutiController::class, 'showVerifikasiCutiPage'])->middleware('Check_Roles_or_Permissions:manajemen_verifikasi_cuti.read')
            ->name('page');
        });

        // Kelola Pegawai route
        Route::apiResource('/kelola/pegawai', PegawaiController::class);
        Route::delete('/kelola/mass-delete/pegawai', [PegawaiController::class, 'hapusMassal'])->name('pegawai.mass.delete');
    });

    //pegawai pages
    Route::prefix('pegawai')->name('pegawai.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'showPegawaiDashboard'])->name('dashboard.page');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
