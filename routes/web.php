<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [MemberController::class, 'dashboard'])->name('welcome');


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
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'edituser'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateuser'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroyuser'])->name('admin.users.delete');
    Route::delete('/admin/stores/{id}', [AdminController::class, 'destroystore'])->name('admin.stores.delete');
    Route::get('/admin/verifikasi', [AdminController::class, 'verifikasi'])->name('admin.verifikasi');
    Route::get('/admin/stores', [AdminController::class, 'toko'])->name('admin.stores');
});
Route::middleware(['auth', 'seller.only'])
->get('/seller/dashboard', fn() => view('seller.dashboard'))
->name('seller.dashboard');

Route::middleware(['auth', 'member.only'])->group(function () {
    Route::get('/member/dashboard', [MemberController::class, 'index'])->name('member.dashboard');
    Route::get('/member/category/{slug}', [MemberController::class, 'sortbycategory'])->name('member.category');
    Route::get('/member/product/{id}', [MemberController::class, 'getProduct'])->name('member.product');
    Route::get('/member/checkout/{id}', [MemberController::class, 'checkout'])->name('member.checkout');
    Route::put('/member', [MemberController::class, 'checkoutProduct'])->name('member.checkout.proses');
    Route::get('/member/productcreate', [MemberController::class, 'createProduct'])->name('member.productcreate');
    Route::get('/member/transactionHistory', [MemberController::class, 'getTransaction'])->name('member.transactionHistory');
    Route::get('/member/topup', [MemberController::class, 'getTopup'])->name('member.topup');
    Route::get('/member/store', [MemberController::class, 'getStore'])->name('member.store');
    Route::post('/member/store', [MemberController::class, 'postStore'])->name('member.store.save');
});




require __DIR__ . '/auth.php';
