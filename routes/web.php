<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\PembayaranController;

// RIWAYAT PEMBAYARAN PER TAMU
Route::get('/tamu/{id}/riwayat-pembayaran', [PembayaranController::class, 'riwayatPerTamu'])
    ->name('pembayaran.riwayat');

//PEMBAYARAN
Route::middleware(['auth', 'role:admin,resepsionis'])->group(function () {
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::get('/pembayaran/create/{reservasi}', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
});

// Halaman publik - Redirect ke login
Route::get('/', function () {
    return redirect('/login');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 👑 ADMIN: Akses penuh ke SEMUA
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('kamar', KamarController::class);
    Route::resource('tamu', TamuController::class);
    Route::resource('reservasi', ReservasiController::class);
});

// 👩‍💼 RESEPSIONIS: Bisa lihat, tambah, edit reservasi — TIDAK BISA hapus
Route::middleware(['auth', 'role:resepsionis'])->group(function () {
    Route::resource('reservasi', ReservasiController::class)->middleware('auth');
    Route::get('/reservasi', [ReservasiController::class, 'index'])->name('reservasi.index');
    Route::get('/reservasi/create', [ReservasiController::class, 'create'])->name('reservasi.create');
    Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');
    Route::get('/reservasi/{reservasi}/edit', [ReservasiController::class, 'edit'])->name('reservasi.edit');
    Route::put('/reservasi/{reservasi}', [ReservasiController::class, 'update'])->name('reservasi.update');
    Route::get('/reservasi/{reservasi}', [ReservasiController::class, 'show'])->name('reservasi.show');
    // ❌ TIDAK ADA route DELETE → aman!
});

require __DIR__.'/auth.php';