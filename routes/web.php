<?php

use App\Http\Controllers\Admin\Laboratorium\LaboratoriumController;
use App\Http\Controllers\PenjadwalanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LaboranController;
use App\Http\Controllers\LaboratoriumTypeController;
use App\Http\Controllers\Admin\Barang\BarangController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('user', UserController::class);
    // Laboratorium
    Route::resource('laboratorium', LaboratoriumController::class);
    // Laboratorium TYPE
    Route::get('/admin/jenis-laboratorium', [LaboratoriumTypeController::class, 'index'])->name('admin.jenis-laboratorium');
    Route::get('/admin/tambah-jenis-laboratorium', [LaboratoriumTypeController::class, 'create'])->name('admin.jenis-laboratorium.create');
    Route::post('/admin/tambah-jenis-laboratorium', [LaboratoriumTypeController::class, 'store']);
    Route::get('/admin/{laboratorium_type:slug}/edit-jenis-laboratorium', [LaboratoriumTypeController::class, 'edit'])->name('admin.jenis-laboratorium.edit');
    Route::put('/admin/{laboratorium_type:slug}/edit-jenis-laboratorium', [LaboratoriumTypeController::class, 'update']);

    // Barang
    Route::get('/admin/barang', [BarangController::class, 'index'])->name('admin.barang');
    Route::get('/admin/barang/tambah-barang', [BarangController::class, 'create'])->name('admin.barang.create');
    Route::post('/admin/barang/tambah-barang', [BarangController::class, 'store']);
    Route::get('/admin/{barang:slug}/ubah-barang', [BarangController::class, 'edit'])->name('admin.barang.edit');
    Route::put('/admin/{barang:slug}/ubah-barang', [BarangController::class, 'update']);
    Route::get('/admin/penjadwalan', [PenjadwalanController::class, 'index'])->name('admin.penjadwalan');
    Route::post('/penjadwalan/generate', [PenjadwalanController::class, 'createGenerateSchedule'])->name('admin.generate');
    Route::post('/penjadwalan/tentatif', [PenjadwalanController::class, 'createTentativeSchedule'])->name('admin.tentative');    
    Route::post('/penjadwalan/{id}/verifikasi', [PenjadwalanController::class, 'updateVerifikasi'])->name('penjadwalan.update-verifikasi');
    Route::get('/penjadwalan/{id}', [PenjadwalanController::class, 'show'])->name('admin.penjadwalan.show');
});

Route::middleware(['auth', 'role:other'])->group(function () {
    Route::get('/other/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/other/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::put('/other/profile', [UserController::class, 'profile_update'])->name('user.profile_update');
    
    Route::post('/penjadwalan/generate', [PenjadwalanController::class, 'createGenerateSchedule'])->name('penjadwalan.generate');
    Route::post('/penjadwalan/tentatif', [PenjadwalanController::class, 'createTentativeSchedule'])->name('penjadwalan.tentative');    
    Route::get('/user/penjadwalan/create', [PenjadwalanController::class, 'create'])->name('user.penjadwalan.create');
    Route::resource('penjadwalan', PenjadwalanController::class);
});

Route::middleware(['auth', 'role:laboran'])->group(function () {
    Route::get('/laboran/dashboard', [LaboranController::class, 'dashboard'])->name('laboran.dashboard');
    Route::get('/laboran/profile', [LaboranController::class, 'profile'])->name('laboran.profile');
    Route::put('/laboran/profile', [LaboranController::class, 'profile_update'])->name('laboran.profile_update');
    Route::get('/laboran/penjadwalan', [PenjadwalanController::class, 'index'])->name('laboran.penjadwalan');
    Route::post('/laboran/penjadwalan/{id}/verifikasi', [PenjadwalanController::class, 'updateVerifikasi'])->name('laboran.update-verifikasi');
    Route::get('/laboran/penjadwalan/{id}', [PenjadwalanController::class, 'show'])->name('laboran.penjadwalan.show');

});

require __DIR__ . '/auth.php';
