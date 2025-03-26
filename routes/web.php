<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginPage'])->name('login.page');
    Route::post('/proses-login', [AuthController::class, 'loginProcess'])->name('login.process');
});

Route::middleware(['auth'])->group(function () {
    //admin pages
    Route::middleware(['CheckRoles:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [Dashboard::class, 'showAdminDashboard'])->name('dashboard.page');

        // Profile routes
        Route::get('/profile', [AdminController::class, 'show'])->name('profile.page');
        Route::put('/profile/update', [AdminController::class, 'update'])->name('profile.update');
    });

    Route::put('/user/change-password',([UserController::class,'updatePassword']))->name('password.update');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
