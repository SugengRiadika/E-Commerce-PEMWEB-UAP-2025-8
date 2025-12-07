<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// User CRUD (admin only)
Route::middleware(['auth', 'admin.only'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::put('/admin/store/{id}/verify', [AdminController::class, 'verifyStore'])->name('admin.store.verify');
    Route::delete('/admin/store/{id}/reject', [AdminController::class, 'rejectStore'])->name('admin.store.reject');
    Route::get('/admin/users', [AdminController::class, 'manage'])->name('admin.users');
    Route::get('/admin/verifikasi', [AdminController::class, 'verifikasi'])->name('admin.verifikasi');
    Route::get('/admin/stores', [AdminController::class, 'toko'])->name('admin.stores');
});

Route::middleware(['auth', 'seller.only'])
    ->get('/seller/dashboard', fn() => view('seller.dashboard'))
    ->name('seller.dashboard');

Route::middleware(['auth', 'member.only'])->group(function () {
    Route::get('/member/dashboard', [MemberController::class, 'index'])->name('member.dashboard');
});


    

require __DIR__.'/auth.php';
