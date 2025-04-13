<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserController;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginPage'])->name('login.page');
    Route::post('/proses-login', [AuthController::class, 'loginProcess'])->name('login.process');
});

Route::middleware(['auth'])->group(function () {
    //admin pages
    Route::middleware(['CheckRoles:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [Dashboard::class, 'showAdminDashboard'])->name('dashboard.page');

        //Kelola Pegawai route
        Route::apiResource('/kelola/pegawai', PegawaiController::class);
        Route::delete('/kelola/mass-delete/pegawai', [PegawaiController::class, 'hapusMassal'])->name('pegawai.mass.delete');

        // Profile routes
        Route::get('/profile', [AdminController::class, 'show'])->name('profile.page');
        Route::put('/profile/update', [AdminController::class, 'update'])->name('profile.update');
    });

    //pegawai pages
    Route::middleware(['CheckRoles:pegawai'])->prefix('pegawai')->name('pegawai.')->group(function () {
        Route::get('/dashboard', [Dashboard::class, 'showPegawaiDashboard'])->name('dashboard.page');

        // Profile routes
        Route::get('/profile', [PegawaiController::class, 'showProfile'])->name('profile.page');
        Route::put('/profile/update', [PegawaiController::class, 'updateProfile'])->name('profile.update');
    });

    Route::put('/user/change-password',([UserController::class,'updatePassword']))->name('password.update');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
