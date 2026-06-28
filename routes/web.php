<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\TopsisController;
use App\Http\Controllers\UserController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    // Dashboard — semua role
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // ─── Hasil Ranking & Penilaian (read-only) — semua role kecuali aksi ─────
    Route::get('/topsis', [TopsisController::class, 'index'])->name('topsis.index');
    Route::get('/topsis/cetak', [TopsisController::class, 'cetakPdf'])->name('topsis.cetak');

    // ─── WARGA: semua bisa lihat index ───────────────────────────────────────
    Route::get('/warga',            [WargaController::class, 'index']  )->name('warga.index');

    // Admin & Kepala Dusun: CRUD penuh warga
    Route::middleware('role:admin,kepala_dusun')->group(function () {
        Route::get   ('/warga/create',        [WargaController::class, 'create'] )->name('warga.create');
        Route::post  ('/warga',               [WargaController::class, 'store']  )->name('warga.store');
        Route::get   ('/warga/{warga}/edit',  [WargaController::class, 'edit']   )->name('warga.edit');
        Route::put   ('/warga/{warga}',       [WargaController::class, 'update'] )->name('warga.update');
        Route::delete('/warga/{warga}',       [WargaController::class, 'destroy'])->name('warga.destroy');
    });

    // ─── KRITERIA: semua bisa lihat ──────────────────────────────────────────
    Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');

    // Penilaian (Nilai Alternatif): admin & kepala dusun saja
    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index')
         ->middleware('role:admin,kepala_dusun');

    // ─── ADMIN ONLY ──────────────────────────────────────────────────────────
    Route::middleware('role:admin')->group(function () {
        // Kriteria CRUD (bukan index)
        Route::get   ('/kriteria/create',         [KriteriaController::class, 'create'] )->name('kriteria.create');
        Route::post  ('/kriteria',                [KriteriaController::class, 'store']  )->name('kriteria.store');
        Route::get   ('/kriteria/{kriterium}/edit',[KriteriaController::class, 'edit']  )->name('kriteria.edit');
        Route::put   ('/kriteria/{kriterium}',    [KriteriaController::class, 'update'] )->name('kriteria.update');
        Route::delete('/kriteria/{kriterium}',    [KriteriaController::class, 'destroy'])->name('kriteria.destroy');

        // Sub Kriteria CRUD penuh
        Route::resource('sub_kriteria', SubKriteriaController::class);

        // Penilaian CRUD (create/store)
        Route::get ('/penilaian/create', [PenilaianController::class, 'create'])->name('penilaian.create');
        Route::post('/penilaian',        [PenilaianController::class, 'store'] )->name('penilaian.store');

        // Manajemen User
        Route::resource('users', UserController::class)->except(['show']);
    });
});
