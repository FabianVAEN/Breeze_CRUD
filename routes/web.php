<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {

    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::resource('users', UserController::class); 
});


// ===================================
// RUTAS PROTEGIDAS PARA ADMINISTRADORES
// ===================================
Route::middleware(['auth', 'role:administrador'])->group(function () {
    
    // Solo si el usuario está logueado Y tiene el rol 'administrador'
    Route::get('/admin/user', function () {
        return view('/admin.user.index');
    })->name('admin.user.index');


});