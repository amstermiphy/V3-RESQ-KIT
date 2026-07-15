<?php

namespace App\Http\Controllers;

use App\Models\HasilSimulasi;
use App\Models\Materi;
use App\Models\ProgressMateri;
use Illuminate\Http\Request;

class SimulasiController extends Controller
{
  /**
   * Lobby simulasi
   */
  public function index()
  {
    if (!session()->has('siswa_id')) {
      return redirect('/identitas');
    }

    return view('siswa.simulasi');
  }

  public function pilihMisi(Request $request)
  {
    $request->validate([
      'misi' => 'required|in:gempa,banjir',
    ]);

    session(['misi' => $request->misi]);

    return response()->json(['success' => true]);
  }

  public function pilihMode(Request $request)
  {
    $request->validate([
      'mode' => 'required|in:digital,resqkit',
    ]);

    session(['mode' => $request->mode]);

    return response()->json(['success' => true]);
  }

  public function gempa()
  {
    if (session('misi') != 'gempa') {
      return redirect('/siswa/simulasi');
    }

    return view('siswa.gempa', [
      'mode' => session('mode'),
    ]);
  }

  public function banjir()
  {
    if (session('misi') != 'banjir') {
      return redirect('/siswa/simulasi');
    }

    return view('siswa.banjir', [
      'mode' => session('mode'),
    ]);
  }

  public function mulai(Request $request)
  {
    if (!session()->has('siswa_id')) {
      return response()->json(['success' => false, 'redirect' => '/identitas'], 401);
    }

    $request->validate([
      'misi' => 'required|in:gempa,banjir',
      'mode' => 'required|in:digital,arduino',
    ]);

    $materi = Materi::where('slug', $request->misi)->firstOrFail();

    session([
      'misi'        => $request->misi,
      'mode'        => $request->mode,
      'waktu_mulai' => now(),
    ]);

    $hasil = HasilSimulasi::create([
      'siswa_id'  => session('siswa_id'),
      'materi_id' => $materi->id,
      'mode'      => $request->mode,
      'status'    => 'proses',
      'skor'      => 0,
    ]);

    session(['hasil_simulasi_id' => $hasil->id]);

    return response()->json([
      'success'  => true,
      'redirect' => '/siswa/' . $request->misi,
    ]);
  }

  /**
   * Dipanggil dari Alpine (gempa.blade.php / banjir.blade.php)
   * begitu node 'ending' tercapai (baik sukses maupun gagal).
   */
  public function selesai(Request $request)
  {
    if (!session()->has('siswa_id') || !session()->has('hasil_simulasi_id')) {
      return response()->json([
        'success' => false,
        'message' => 'Sesi simulasi tidak ditemukan.',
      ], 400);
    }

    $request->validate([
      'skor'   => 'required|integer|min:0',
      'status' => 'required|in:selesai,gagal',
    ]);

    $hasil = HasilSimulasi::find(session('hasil_simulasi_id'));

    if (!$hasil) {
      return response()->json([
        'success' => false,
        'message' => 'Data simulasi tidak ditemukan.',
      ], 404);
    }

    $durasi = session()->has('waktu_mulai')
      ? now()->diffInSeconds(session('waktu_mulai'))
      : 0;

    $hasil->update([
      'skor'   => $request->skor,
      'durasi' => $durasi,
      'status' => $request->status,
    ]);

    // Progress materi cuma diupdate kalau misinya beneran selesai (bukan gagal)
    if ($request->status === 'selesai') {
      ProgressMateri::updateOrCreate(
        [
          'siswa_id'  => session('siswa_id'),
          'materi_id' => $hasil->materi_id,
        ],
        [
          'status'       => 'selesai',
          'nilai_quiz'   => min(100, $request->skor),
          'completed_at' => now(),
        ]
      );
    }

    session()->forget(['hasil_simulasi_id', 'waktu_mulai']);

    return response()->json([
      'success' => true,
      'skor'    => $hasil->skor,
      'status'  => $hasil->status,
    ]);
  }
}
