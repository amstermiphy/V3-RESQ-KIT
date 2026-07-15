<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\SimulasiController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AuthController;

Route::controller(LandingController::class)->group(function () {
  Route::get('/', 'index');
});

Route::controller(SiswaController::class)->group(function () {
  Route::get('/identitas', 'identitas');
  Route::post('/identitas', 'store');
  Route::get('/siswa/home', 'home');
  Route::post('/siswa/logout', 'logout');
});

Route::controller(SimulasiController::class)->group(function () {
  Route::get('/siswa/simulasi', 'index');
  Route::post('/siswa/pilih-misi', 'pilihMisi');
  Route::post('/siswa/pilih-mode', 'pilihMode');
  Route::post('/siswa/mulai', 'mulai')->name('siswa.mulai');
  Route::get('/siswa/gempa', 'gempa');
  Route::get('/siswa/banjir', 'banjir');
  Route::post('/siswa/simulasi/selesai', 'selesai')->name('siswa.simulasi.selesai');
});

// ===== AUTH =====
// ===== AUTH =====
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===== GURU (diproteksi middleware auth + role guru) =====
Route::middleware('guru')->controller(GuruController::class)->group(function () {
  Route::get('/guru/dashboard', 'dashboard')->name('guru.dashboard');
  Route::get('/guru/siswa', 'siswa')->name('guru.siswa');
  Route::get('/guru/siswa/{siswa}', 'siswaDetail')->name('guru.siswa.detail');
  Route::get('/guru/materi', 'materi')->name('guru.materi');
  Route::get('/guru/penilaian', 'penilaian')->name('guru.penilaian');
  Route::get('/guru/laporan', 'laporan')->name('guru.laporan');
});

Route::controller(MateriController::class)->group(function () {
  Route::get('/siswa/materi', 'index');
  Route::get('/siswa/materi/{slug}', 'show');
});
