@extends('layouts.guru')

@section('title', 'Data Siswa')

@section('content')

  <div class="flex flex-col gap-5">

    {{-- ============== HEADER + FILTER ============== --}}
    <div class="flex flex-col gap-4 rounded-3xl bg-white p-6 shadow-sm shadow-slate-200/60 sm:flex-row sm:items-center sm:justify-between">

      <div>
        <h2 class="text-lg font-black text-slate-800">Data Siswa</h2>
        <p class="text-sm text-slate-400">Daftar siswa terdaftar beserta progress belajar</p>
      </div>

      <form method="GET" action="{{ route('guru.siswa') }}" class="flex flex-col gap-3 sm:flex-row sm:items-center">

        <div class="relative">
          <i data-lucide="search" class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"></i>
          <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari nama siswa..."
            class="w-full rounded-2xl border border-slate-200 py-2.5 pl-10 pr-4 text-sm font-medium text-slate-700 focus:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-100 sm:w-56">
        </div>

        <select name="kelas_id" onchange="this.form.submit()"
          class="rounded-2xl border border-slate-200 px-4 py-2.5 text-sm font-bold text-slate-600 focus:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-100">
          <option value="">Semua Kelas</option>
          @foreach ($kelas as $k)
            <option value="{{ $k->id }}" @selected(request('kelas_id') == $k->id)>
              {{ $k->nama_kelas }}
            </option>
          @endforeach
        </select>

        <button type="submit" class="rounded-2xl bg-blue-600 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-blue-700">
          Terapkan
        </button>

        @if (request('cari') || request('kelas_id'))
          <a href="{{ route('guru.siswa') }}" class="text-center text-sm font-bold text-slate-400 transition hover:text-slate-600">
            Reset
          </a>
        @endif

      </form>

    </div>

    {{-- ============== TABEL SISWA ============== --}}
    <div class="overflow-hidden rounded-3xl bg-white shadow-sm shadow-slate-200/60">

      <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">

          <thead>
            <tr class="border-b border-slate-100 bg-slate-50/60 text-xs font-black uppercase tracking-wide text-slate-400">
              <th class="px-6 py-4">Siswa</th>
              <th class="px-6 py-4">Kelas</th>
              <th class="px-6 py-4">Materi Selesai</th>
              <th class="px-6 py-4">Simulasi Selesai</th>
              <th class="px-6 py-4">Rata-rata Skor</th>
              <th class="px-6 py-4 text-center">Aksi</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-slate-100">

            @forelse ($siswa as $s)
              @php
                $materiSelesai = $s->progressMateris->where('status', 'selesai')->count();
                $simulasiSelesai = $s->hasilSimulasis->where('status', 'selesai');
                $rataSkor = round($simulasiSelesai->avg('skor') ?? 0);
                $avatar = $s->jenis_kelamin === 'P' ? 'reka' : 'aksa';
              @endphp

              <tr class="transition hover:bg-slate-50/60">

                <td class="px-6 py-4">
                  <div class="flex items-center gap-3">
                    <img src="{{ Vite::asset('resources/images/mascot/' . $avatar . '.png') }}"
                      class="h-10 w-10 shrink-0 rounded-full bg-slate-50 object-contain p-1" alt="{{ $s->nama }}">
                    <div>
                      <p class="font-bold text-slate-700">{{ $s->nama }}</p>
                      <p class="text-xs text-slate-400">{{ $s->jenis_kelamin === 'P' ? 'Perempuan' : 'Laki-laki' }}</p>
                    </div>
                  </div>
                </td>

                <td class="px-6 py-4">
                  <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-bold text-blue-600">
                    {{ $s->kelas->nama_kelas ?? '-' }}
                  </span>
                </td>

                <td class="px-6 py-4">
                  <span class="font-bold text-slate-700">{{ $materiSelesai }}</span>
                  <span class="text-slate-400">/ {{ \App\Models\Materi::where('status', true)->count() }}</span>
                </td>

                <td class="px-6 py-4">
                  <span class="font-bold text-slate-700">{{ $simulasiSelesai->count() }}</span>
                </td>

                <td class="px-6 py-4">
                  @if ($simulasiSelesai->count() > 0)
                    <span
                      class="rounded-full px-3 py-1 text-xs font-black
                        {{ $rataSkor >= 80 ? 'bg-emerald-50 text-emerald-600' : ($rataSkor >= 60 ? 'bg-amber-50 text-amber-600' : 'bg-red-50 text-red-500') }}">
                      {{ $rataSkor }}
                    </span>
                  @else
                    <span class="text-xs font-medium text-slate-300">Belum ada</span>
                  @endif
                </td>

                <td class="px-6 py-4 text-center">
                  <a href="{{ route('guru.siswa.detail', $s->id) }}"
                    class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 px-3.5 py-1.5 text-xs font-bold text-slate-600 transition hover:border-blue-400 hover:text-blue-600">
                    <i data-lucide="eye" class="h-3.5 w-3.5"></i>
                    Detail
                  </a>
                </td>

              </tr>

            @empty

              <tr>
                <td colspan="6" class="px-6 py-16 text-center">
                  <div class="flex flex-col items-center gap-3">
                    <i data-lucide="users" class="h-10 w-10 text-slate-300"></i>
                    <p class="text-sm font-bold text-slate-400">Belum ada siswa yang cocok dengan pencarian</p>
                  </div>
                </td>
              </tr>
            @endforelse

          </tbody>

        </table>
      </div>

      @if ($siswa->hasPages())
        <div class="border-t border-slate-100 px-6 py-4">
          {{ $siswa->links() }}
        </div>
      @endif

    </div>

  </div>

@endsection
