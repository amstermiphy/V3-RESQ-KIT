@extends('layouts.guru')

@section('title', 'Detail Siswa')

@section('content')

  <div class="flex flex-col gap-5">

    {{-- ============== BACK ============== --}}
    <a href="{{ route('guru.siswa') }}" class="inline-flex w-fit items-center gap-2 text-sm font-bold text-slate-500 transition hover:text-blue-600">
      <i data-lucide="arrow-left" class="h-4 w-4"></i>
      Kembali ke Data Siswa
    </a>

    {{-- ============== PROFIL SISWA ============== --}}
    <div class="flex flex-col gap-6 rounded-3xl bg-white p-6 shadow-sm shadow-slate-200/60 sm:flex-row sm:items-center sm:justify-between">

      <div class="flex items-center gap-4">

        @php $avatar = $siswa->jenis_kelamin === 'P' ? 'reka' : 'aksa'; @endphp

        <img src="{{ Vite::asset('resources/images/mascot/' . $avatar . '.png') }}"
          class="h-16 w-16 shrink-0 rounded-full bg-slate-50 object-contain p-1.5" alt="{{ $siswa->nama }}">

        <div>
          <h2 class="text-xl font-black text-slate-800">{{ $siswa->nama }}</h2>
          <div class="mt-1 flex items-center gap-2">
            <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-bold text-blue-600">
              {{ $siswa->kelas->nama_kelas ?? '-' }}
            </span>
            <span class="text-xs font-medium text-slate-400">
              {{ $siswa->jenis_kelamin === 'P' ? 'Perempuan' : 'Laki-laki' }}
            </span>
          </div>
        </div>

      </div>

    </div>

    {{-- ============== STATISTIK ============== --}}
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">

      <div class="flex items-center gap-4 rounded-3xl bg-white p-5 shadow-sm shadow-slate-200/60">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-500">
          <i data-lucide="book-open" class="h-7 w-7"></i>
        </div>
        <div>
          <p class="text-sm font-bold text-slate-500">Materi Selesai</p>
          <p class="text-2xl font-black text-slate-800">{{ $materiSelesai }} <span class="text-base font-bold text-slate-400">/
              {{ $totalMateriAktif }}</span></p>
        </div>
      </div>

      <div class="flex items-center gap-4 rounded-3xl bg-white p-5 shadow-sm shadow-slate-200/60">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-amber-50 text-amber-500">
          <i data-lucide="gamepad-2" class="h-7 w-7"></i>
        </div>
        <div>
          <p class="text-sm font-bold text-slate-500">Simulasi Selesai</p>
          <p class="text-2xl font-black text-slate-800">{{ $riwayatSimulasi->where('status', 'selesai')->count() }}</p>
        </div>
      </div>

      <div class="flex items-center gap-4 rounded-3xl bg-white p-5 shadow-sm shadow-slate-200/60">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-violet-50 text-violet-500">
          <i data-lucide="trophy" class="h-7 w-7"></i>
        </div>
        <div>
          <p class="text-sm font-bold text-slate-500">Rata-rata Skor</p>
          <p class="text-2xl font-black text-slate-800">{{ $rataSkor }}</p>
        </div>
      </div>

    </div>

    {{-- ============== PROGRESS MATERI ============== --}}
    <div class="rounded-3xl bg-white p-6 shadow-sm shadow-slate-200/60">

      <h3 class="text-base font-black text-slate-800">Progress Materi</h3>

      <div class="mt-4 flex flex-col gap-3">

        @forelse ($siswa->progressMateris as $p)
          <div class="flex items-center justify-between rounded-2xl bg-slate-50 p-4">

            <div class="flex items-center gap-3">
              <span class="text-2xl">{{ $p->materi->icon ?? '📘' }}</span>
              <div>
                <p class="text-sm font-bold text-slate-700">{{ $p->materi->judul ?? '-' }}</p>
                <p class="text-xs text-slate-400">Nilai Quiz: {{ $p->nilai_quiz }}</p>
              </div>
            </div>

            <span
              class="rounded-full px-3 py-1 text-xs font-black
              {{ $p->status === 'selesai' ? 'bg-emerald-50 text-emerald-600' : ($p->status === 'proses' ? 'bg-amber-50 text-amber-600' : 'bg-slate-100 text-slate-400') }}">
              {{ ucfirst($p->status) }}
            </span>

          </div>
        @empty
          <p class="py-6 text-center text-sm font-medium text-slate-400">Belum ada progress materi.</p>
        @endforelse

      </div>

    </div>

    {{-- ============== RIWAYAT SIMULASI ============== --}}
    <div class="rounded-3xl bg-white p-6 shadow-sm shadow-slate-200/60">

      <h3 class="text-base font-black text-slate-800">Riwayat Simulasi</h3>

      <div class="mt-4 overflow-x-auto">
        <table class="w-full text-left text-sm">

          <thead>
            <tr class="border-b border-slate-100 text-xs font-black uppercase tracking-wide text-slate-400">
              <th class="py-3 pr-4">Materi</th>
              <th class="py-3 pr-4">Mode</th>
              <th class="py-3 pr-4">Skor</th>
              <th class="py-3 pr-4">Status</th>
              <th class="py-3 pr-4">Tanggal</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-slate-100">

            @forelse ($riwayatSimulasi as $h)
              <tr>
                <td class="py-3 pr-4 font-bold text-slate-700">{{ $h->materi->judul ?? '-' }}</td>
                <td class="py-3 pr-4">
                  <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-600">
                    {{ $h->mode === 'arduino' ? 'RESQ-KIT' : 'Digital' }}
                  </span>
                </td>
                <td class="py-3 pr-4 font-black text-slate-700">{{ $h->skor }}</td>
                <td class="py-3 pr-4">
                  <span
                    class="rounded-full px-2.5 py-1 text-xs font-black
                    {{ $h->status === 'selesai' ? 'bg-emerald-50 text-emerald-600' : ($h->status === 'gagal' ? 'bg-red-50 text-red-500' : 'bg-slate-100 text-slate-400') }}">
                    {{ ucfirst($h->status) }}
                  </span>
                </td>
                <td class="py-3 pr-4 text-slate-400">{{ $h->created_at->format('d M Y, H:i') }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="py-8 text-center text-sm font-medium text-slate-400">
                  Belum ada riwayat simulasi.
                </td>
              </tr>
            @endforelse

          </tbody>

        </table>
      </div>

    </div>

  </div>

@endsection
