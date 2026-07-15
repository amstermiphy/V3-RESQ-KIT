<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Materi;
use App\Models\ProgressMateri;
use App\Models\HasilSimulasi;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GuruController extends Controller
{
  /**
   * Dashboard Guru
   */
  public function dashboard()
  {
    $totalSiswa = Siswa::count();

    $materiAktif = Materi::where('status', true)->count();

    $simulasiHariIni = HasilSimulasi::whereDate('created_at', today())->count();

    $rataNilai = (int) round(
      HasilSimulasi::where('status', 'selesai')->avg('skor') ?? 0
    );

    // ===== Grafik 7 hari terakhir =====
    $labelHari = [];
    $dataNilaiMingguan = [];

    for ($i = 6; $i >= 0; $i--) {
      $tanggal = Carbon::now()->subDays($i);

      $labelHari[] = $tanggal->translatedFormat('D'); // Sen, Sel, dst (locale id perlu di-set di config)

      $rata = HasilSimulasi::where('status', 'selesai')
        ->whereDate('created_at', $tanggal)
        ->avg('skor');

      $dataNilaiMingguan[] = (int) round($rata ?? 0);
    }

    // ===== Aktivitas terbaru: gabungan simulasi selesai + materi selesai =====
    $simulasiTerbaru = HasilSimulasi::with(['siswa', 'materi'])
      ->where('status', 'selesai')
      ->latest()
      ->take(5)
      ->get()
      ->map(function ($h) {
        return [
          'nama'   => $h->siswa->nama ?? '-',
          'aksi'   => 'menyelesaikan simulasi',
          'objek'  => $h->materi->judul ?? '-',
          'waktu'  => $h->created_at->diffForHumans(),
          'avatar' => $h->materi->slug === 'gempa' ? 'aksa' : 'reka',
          'status' => 'sukses',
          'sort'   => $h->created_at,
        ];
      });

    $materiTerbaru = ProgressMateri::with(['siswa', 'materi'])
      ->where('status', 'selesai')
      ->latest('completed_at')
      ->take(5)
      ->get()
      ->map(function ($p) {
        return [
          'nama'   => $p->siswa->nama ?? '-',
          'aksi'   => 'menyelesaikan materi',
          'objek'  => $p->materi->judul ?? '-',
          'waktu'  => optional($p->completed_at)->diffForHumans() ?? '-',
          'avatar' => $p->materi->slug === 'gempa' ? 'aksa' : 'reka',
          'status' => 'sukses',
          'sort'   => $p->completed_at ?? $p->updated_at,
        ];
      });

    $aktivitasTerbaru = $simulasiTerbaru
      ->concat($materiTerbaru)
      ->sortByDesc('sort')
      ->take(4)
      ->map(function ($item) {
        unset($item['sort']);
        return $item;
      })
      ->values()
      ->all();

    return view('guru.dashboard', compact(
      'totalSiswa',
      'materiAktif',
      'simulasiHariIni',
      'rataNilai',
      'labelHari',
      'dataNilaiMingguan',
      'aktivitasTerbaru'
    ));

    // Catatan: $arduinoOnline, $arduinoPort, dll di view masih pakai
    // default fallback (?? true / ?? 'COM4') karena belum ada tabel/model
    // Arduino. Nanti begitu ada tabel arduino_logs atau semacamnya,
    // tinggal tambah query di sini.
  }

  /**
   * Data Siswa
   */
  public function siswa(Request $request)
  {
    $query = Siswa::with(['kelas', 'progressMateris', 'hasilSimulasis']);

    if ($request->filled('kelas_id')) {
      $query->where('kelas_id', $request->kelas_id);
    }

    if ($request->filled('cari')) {
      $query->where('nama', 'like', '%' . $request->cari . '%');
    }

    $siswa = $query->orderBy('nama')->paginate(15);

    $kelas = Kelas::orderBy('nama_kelas')->get();

    return view('guru.siswa', compact('siswa', 'kelas'));
  }

  /**
   * Materi
   */
  public function materi()
  {
    $totalSiswa = Siswa::count();

    $materi = Materi::withCount([
      'progressMateris as selesai_count' => function ($q) {
        $q->where('status', 'selesai');
      },
    ])->orderBy('id')->get()->map(function ($m) use ($totalSiswa) {
      $m->persentase_selesai = $totalSiswa > 0
        ? round(($m->selesai_count / $totalSiswa) * 100)
        : 0;
      return $m;
    });

    return view('guru.materi', compact('materi', 'totalSiswa'));
  }

  /**
   * Penilaian
   */
  public function penilaian(Request $request)
  {
    $query = HasilSimulasi::with(['siswa.kelas', 'materi']);

    if ($request->filled('materi_id')) {
      $query->where('materi_id', $request->materi_id);
    }

    if ($request->filled('mode')) {
      $query->where('mode', $request->mode);
    }

    if ($request->filled('status')) {
      $query->where('status', $request->status);
    }

    $hasil = $query->latest()->paginate(15);

    $materi = Materi::orderBy('judul')->get();

    return view('guru.penilaian', compact('hasil', 'materi'));
  }

  /**
   * Laporan
   */
  public function laporan(Request $request)
  {
    $kelasId = $request->kelas_id;

    $siswaQuery = Siswa::with(['kelas', 'progressMateris.materi', 'hasilSimulasis.materi']);

    if ($kelasId) {
      $siswaQuery->where('kelas_id', $kelasId);
    }

    $siswa = $siswaQuery->orderBy('nama')->get()->map(function ($s) {
      $totalMateri = $s->progressMateris->where('status', 'selesai')->count();
      $rataSkor = round($s->hasilSimulasis->where('status', 'selesai')->avg('skor') ?? 0);

      return [
        'id'            => $s->id,
        'nama'          => $s->nama,
        'kelas'         => $s->kelas->nama_kelas ?? '-',
        'materi_selesai' => $totalMateri,
        'rata_skor'     => $rataSkor,
        'jumlah_simulasi' => $s->hasilSimulasis->where('status', 'selesai')->count(),
      ];
    });

    $kelas = Kelas::orderBy('nama_kelas')->get();

    return view('guru.laporan', compact('siswa', 'kelas'));
  }

  /**
   * Detail Siswa
   */
  public function siswaDetail(Siswa $siswa)
  {
    $siswa->load(['kelas', 'progressMateris.materi', 'hasilSimulasis.materi']);

    $totalMateriAktif = Materi::where('status', true)->count();

    $materiSelesai = $siswa->progressMateris->where('status', 'selesai')->count();

    $simulasiSelesai = $siswa->hasilSimulasis->where('status', 'selesai');

    $rataSkor = round($simulasiSelesai->avg('skor') ?? 0);

    $riwayatSimulasi = $siswa->hasilSimulasis
      ->sortByDesc('created_at')
      ->values();

    return view('guru.siswa-detail', compact(
      'siswa',
      'totalMateriAktif',
      'materiSelesai',
      'rataSkor',
      'riwayatSimulasi'
    ));
  }
}
