<?php

use App\Http\Controllers\Admin\Laboratorium\LaboratoriumController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LaboranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserControler;
use Illuminate\Support\Facades\Route;

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
});

Route::middleware(['auth', 'role:laboran'])->group(function(){
    Route::get('/laboran/dashboard', [LaboranController::class, 'dashboard'])->name('laboran.dashboard');
});

require __DIR__.'/auth.php';
