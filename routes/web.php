<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserControler;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LaboranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaboratoriumTypeController;

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

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('user', UserControler::class);

    // Laboratorium TYPE
    Route::get('/admin/jenis-laboratorium', [LaboratoriumTypeController::class, 'index'])->name('admin.jenis-laboratorium');
    // Route::post('/karyawan/tambah-karyawan', [AdminKaryawanController::class, 'tambah']); 

});

Route::middleware(['auth', 'role:laboran'])->group(function(){
    Route::get('/laboran/dashboard', [LaboranController::class, 'dashboard'])->name('laboran.dashboard');
});

require __DIR__.'/auth.php';
