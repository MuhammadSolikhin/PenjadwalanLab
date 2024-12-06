<?php

use App\Http\Controllers\Admin\Laboratorium\LaboratoriumController;
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

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('user', UserControler::class);

    // Laboratorium
    Route::get('/admin/laboratorium', [LaboratoriumController::class, 'index'])->name('admin.laboratorium');
    Route::get('/admin/laboratorium/tambah-laboratorium', [LaboratoriumController::class, 'create'])->name('admin.laboratorium.create');
    Route::post('/admin/laboratorium/tambah-laboratorium', [LaboratoriumController::class, 'store']);
    Route::get('/admin/{laboratorium:slug}/edit', [LaboratoriumController::class, 'edit'])->name('admin.laboratorium.edit');
    Route::put('/admin/{laboratorium:slug}/edit', [LaboratoriumController::class, 'update']);

    // Laboratorium TYPE
    Route::get('/admin/jenis-laboratorium', [LaboratoriumTypeController::class, 'index'])->name('admin.jenis-laboratorium');
    Route::get('/admin/tambah-jenis-laboratorium', [LaboratoriumTypeController::class, 'create'])->name('admin.jenis-laboratorium.create');
    Route::post('/admin/tambah-jenis-laboratorium', [LaboratoriumTypeController::class, 'store']);
    Route::get('/admin/{laboratorium_type:slug}/edit-jenis-laboratorium', [LaboratoriumTypeController::class, 'edit'])->name('admin.jenis-laboratorium.edit');
    Route::put('/admin/{laboratorium_type:slug}/edit-jenis-laboratorium', [LaboratoriumTypeController::class, 'update']);
});

Route::middleware(['auth', 'role:laboran'])->group(function(){
    Route::get('/laboran/dashboard', [LaboranController::class, 'dashboard'])->name('laboran.dashboard');
});

require __DIR__.'/auth.php';
