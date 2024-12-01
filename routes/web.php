<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserControler;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LaboranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Meja\MejaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('user', UserControler::class);

    // Meja
    Route::get('/admin/meja', [MejaController::class, 'index'])->name('admin.meja');
    Route::get('/admin/meja/tambah-meja', [MejaController::class, 'create'])->name('admin.meja.create');
    Route::post('/admin/meja/tambah-meja', [MejaController::class, 'store']);
    Route::get('/admin/{meja:no}/ubah-meja', [MejaController::class, 'edit'])->name('admin.meja.edit');
    Route::put('/admin/{meja:no}/ubah-meja', [MejaController::class, 'update']);
    
});

Route::middleware(['auth', 'role:laboran'])->group(function(){
    Route::get('/laboran/dashboard', [LaboranController::class, 'dashboard'])->name('laboran.dashboard');
});

require __DIR__.'/auth.php';
