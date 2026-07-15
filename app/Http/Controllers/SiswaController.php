<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Materi;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
  /**
   * Halaman isi identitas
   */
  public function identitas()
  {
    $kelas = Kelas::orderBy('nama_kelas')->get();

    return view('landing.identitas', compact('kelas'));
  }

  /**
   * Simpan identitas siswa
   */
  public function store(Request $request)
  {
    $request->validate([
      'nama'          => 'required|string|max:100',
      'kelas_id'      => 'required|exists:kelas,id',
      'jenis_kelamin' => 'nullable|in:L,P',
    ]);

    $siswa = Siswa::where('nama', $request->nama)
      ->where('kelas_id', $request->kelas_id)
      ->first();

    if (!$siswa) {
      $siswa = Siswa::create([
        'nama'          => $request->nama,
        'kelas_id'      => $request->kelas_id,
        'jenis_kelamin' => $request->jenis_kelamin,
      ]);
    }

    session([
      'siswa_id' => $siswa->id,
      'nama'     => $siswa->nama,
      'kelas_id' => $siswa->kelas_id,
    ]);

    return redirect('/siswa/home');
  }

  /**
   * Dashboard siswa
   */
  public function home()
  {
    if (!session()->has('siswa_id')) {
      return redirect('/identitas');
    }

    $siswa = Siswa::with(['kelas', 'progressMateris'])
      ->find(session('siswa_id'));

    if (!$siswa) {
      session()->forget(['siswa_id', 'nama', 'kelas_id']);
      return redirect('/identitas');
    }

    $totalMateriAktif = Materi::where('status', true)->count();

    $materiSelesai = $siswa->progressMateris->where('status', 'selesai')->count();

    $persentaseProgress = $totalMateriAktif > 0
      ? round(($materiSelesai / $totalMateriAktif) * 100)
      : 0;

    return view('siswa.home', compact(
      'siswa',
      'materiSelesai',
      'totalMateriAktif',
      'persentaseProgress'
    ));
  }

  /**
   * Keluar dari sesi siswa
   */
  public function logout()
  {
    session()->forget([
      'siswa_id',
      'nama',
      'kelas_id',
    ]);

    return redirect('/');
  }
}
