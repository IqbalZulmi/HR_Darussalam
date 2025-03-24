<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', [Dashboard::class, 'showAdminDashboard'])->name('admin.dashboard.page');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginPage'])->name('login.page');
    Route::post('/proses-login', [AuthController::class, 'loginProcess'])->name('login.process');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
