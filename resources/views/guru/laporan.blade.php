@extends('layouts.guru')

@section('title', 'Laporan')

@section('content')

  <div class="flex flex-col gap-5">

    {{-- ============== HEADER + FILTER ============== --}}
    <div class="flex flex-col gap-4 rounded-3xl bg-white p-6 shadow-sm shadow-slate-200/60 sm:flex-row sm:items-center sm:justify-between">

      <div>
        <h2 class="text-lg font-black text-slate-800">Laporan Perkembangan Siswa</h2>
        <p class="text-sm text-slate-400">Ringkasan materi & simulasi tiap siswa</p>
      </div>

      <form method="GET" action="{{ route('guru.laporan') }}" class="flex items-center gap-3">

        <select name="kelas_id" onchange="this.form.submit()"
          class="rounded-2xl border border-slate-200 px-4 py-2.5 text-sm font-bold text-slate-600 focus:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-100">
          <option value="">Semua Kelas</option>
          @foreach ($kelas as $k)
            <option value="{{ $k->id }}" @selected(request('kelas_id') == $k->id)>
              {{ $k->nama_kelas }}
            </option>
          @endforeach
        </select>

        <button type="button" onclick="window.print()"
          class="flex items-center gap-2 rounded-2xl bg-blue-600 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-blue-700">
          <i data-lucide="printer" class="h-4 w-4"></i>
          Cetak / Export PDF
        </button>

      </form>

    </div>

    {{-- ============== RINGKASAN ============== --}}
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">

      @php
        $totalSiswaLaporan = $siswa->count();
        $rataKelas = $totalSiswaLaporan > 0 ? round($siswa->avg('rata_skor')) : 0;
        $siswaLulus = $siswa->where('rata_skor', '>=', 70)->count();
      @endphp

      <div class="flex items-center gap-4 rounded-3xl bg-white p-5 shadow-sm shadow-slate-200/60">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-blue-500">
          <i data-lucide="users" class="h-7 w-7"></i>
        </div>
        <div>
          <p class="text-sm font-bold text-slate-500">Total Siswa</p>
          <p class="text-2xl font-black text-slate-800">{{ $totalSiswaLaporan }}</p>
        </div>
      </div>

      <div class="flex items-center gap-4 rounded-3xl bg-white p-5 shadow-sm shadow-slate-200/60">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-violet-50 text-violet-500">
          <i data-lucide="trophy" class="h-7 w-7"></i>
        </div>
        <div>
          <p class="text-sm font-bold text-slate-500">Rata-rata Kelas</p>
          <p class="text-2xl font-black text-slate-800">{{ $rataKelas }}</p>
        </div>
      </div>

      <div class="flex items-center gap-4 rounded-3xl bg-white p-5 shadow-sm shadow-slate-200/60">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-500">
          <i data-lucide="badge-check" class="h-7 w-7"></i>
        </div>
        <div>
          <p class="text-sm font-bold text-slate-500">Skor ≥ 70</p>
          <p class="text-2xl font-black text-slate-800">{{ $siswaLulus }} <span class="text-base font-bold text-slate-400">siswa</span></p>
        </div>
      </div>

    </div>

    {{-- ============== TABEL LAPORAN ============== --}}
    <div class="overflow-hidden rounded-3xl bg-white shadow-sm shadow-slate-200/60">

      <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">

          <thead>
            <tr class="border-b border-slate-100 bg-slate-50/60 text-xs font-black uppercase tracking-wide text-slate-400">
              <th class="px-6 py-4">#</th>
              <th class="px-6 py-4">Nama Siswa</th>
              <th class="px-6 py-4">Kelas</th>
              <th class="px-6 py-4">Materi Selesai</th>
              <th class="px-6 py-4">Jumlah Simulasi</th>
              <th class="px-6 py-4">Rata-rata Skor</th>
              <th class="px-6 py-4">Predikat</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-slate-100">

            @forelse ($siswa as $i => $s)
              @php
                $predikat = match (true) {
                    $s['rata_skor'] >= 90 => ['Ahli Mitigasi', 'bg-violet-50 text-violet-600'],
                    $s['rata_skor'] >= 70 => ['Sahabat Siaga', 'bg-emerald-50 text-emerald-600'],
                    $s['jumlah_simulasi'] > 0 => ['Pemberani Cilik', 'bg-amber-50 text-amber-600'],
                    default => ['Belum Mulai', 'bg-slate-100 text-slate-400'],
                };
              @endphp

              <tr class="transition hover:bg-slate-50/60">

                <td class="px-6 py-4 font-bold text-slate-400">{{ $i + 1 }}</td>

                <td class="px-6 py-4">
                  <a href="{{ route('guru.siswa.detail', $s['id']) }}" class="font-bold text-slate-700 transition hover:text-blue-600">
                    {{ $s['nama'] }}
                  </a>
                </td>

                <td class="px-6 py-4">
                  <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-bold text-blue-600">
                    {{ $s['kelas'] }}
                  </span>
                </td>

                <td class="px-6 py-4 font-bold text-slate-700">
                  {{ $s['materi_selesai'] }}
                </td>

                <td class="px-6 py-4 font-bold text-slate-700">
                  {{ $s['jumlah_simulasi'] }}
                </td>

                <td class="px-6 py-4">
                  @if ($s['jumlah_simulasi'] > 0)
                    <span
                      class="rounded-full px-3 py-1 text-xs font-black
                        {{ $s['rata_skor'] >= 80 ? 'bg-emerald-50 text-emerald-600' : ($s['rata_skor'] >= 60 ? 'bg-amber-50 text-amber-600' : 'bg-red-50 text-red-500') }}">
                      {{ $s['rata_skor'] }}
                    </span>
                  @else
                    <span class="text-xs font-medium text-slate-300">Belum ada</span>
                  @endif
                </td>

                <td class="px-6 py-4">
                  <span class="rounded-full px-3 py-1 text-xs font-black {{ $predikat[1] }}">
                    {{ $predikat[0] }}
                  </span>
                </td>

              </tr>

            @empty

              <tr>
                <td colspan="7" class="px-6 py-16 text-center">
                  <div class="flex flex-col items-center gap-3">
                    <i data-lucide="file-bar-chart" class="h-10 w-10 text-slate-300"></i>
                    <p class="text-sm font-bold text-slate-400">Belum ada data siswa untuk kelas ini</p>
                  </div>
                </td>
              </tr>
            @endforelse

          </tbody>

        </table>
      </div>

    </div>

  </div>

@endsection
