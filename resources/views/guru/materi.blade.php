@extends('layouts.guru')

@section('title', 'Materi')

@section('content')

  <div class="flex flex-col gap-5">

    {{-- ============== HEADER ============== --}}
    <div class="flex flex-col gap-1 rounded-3xl bg-white p-6 shadow-sm shadow-slate-200/60 sm:flex-row sm:items-center sm:justify-between">

      <div>
        <h2 class="text-lg font-black text-slate-800">Data Materi</h2>
        <p class="text-sm text-slate-400">Pantau materi yang tersedia dan progress siswa mempelajarinya</p>
      </div>

      <span class="w-fit rounded-full bg-blue-50 px-4 py-2 text-xs font-bold text-blue-600">
        {{ $materi->where('status', true)->count() }} materi aktif dari {{ $materi->count() }} total
      </span>

    </div>

    {{-- ============== CARD MATERI ============== --}}
    <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-3">

      @forelse ($materi as $m)
        <div
          class="flex flex-col overflow-hidden rounded-3xl bg-white shadow-sm shadow-slate-200/60 transition duration-300 hover:-translate-y-1 hover:shadow-lg">

          {{-- Header warna --}}
          <div class="p-6 text-center text-white"
            style="background: linear-gradient(135deg, {{ $m->warna ?? '#3B82F6' }}, {{ $m->warna ?? '#3B82F6' }}cc);">

            <div class="text-6xl">{{ $m->icon ?? '📘' }}</div>

            <h3 class="mt-3 text-2xl font-black">{{ $m->judul }}</h3>

            <span class="mt-2 inline-flex items-center gap-1.5 rounded-full bg-white/20 px-3 py-1 text-xs font-bold backdrop-blur">
              <span class="h-1.5 w-1.5 rounded-full {{ $m->status ? 'bg-emerald-300' : 'bg-slate-300' }}"></span>
              {{ $m->status ? 'Aktif' : 'Nonaktif' }}
            </span>

          </div>

          {{-- Body --}}
          <div class="flex flex-1 flex-col p-6">

            <p class="text-sm leading-6 text-slate-500">
              {{ $m->deskripsi ?? 'Belum ada deskripsi.' }}
            </p>

            {{-- Progress bar --}}
            <div class="mt-5">

              <div class="mb-1.5 flex items-center justify-between text-xs font-bold text-slate-400">
                <span>Siswa Menyelesaikan</span>
                <span>{{ $m->selesai_count }} / {{ $totalSiswa }}</span>
              </div>

              <div class="h-2.5 overflow-hidden rounded-full bg-slate-100">
                <div class="h-full rounded-full transition-all duration-700"
                  style="width: {{ $m->persentase_selesai }}%; background: {{ $m->warna ?? '#3B82F6' }};"></div>
              </div>

              <p class="mt-1.5 text-right text-xs font-black" style="color: {{ $m->warna ?? '#3B82F6' }};">
                {{ $m->persentase_selesai }}%
              </p>

            </div>

            <a href="{{ route('guru.penilaian', ['materi_id' => $m->id]) }}"
              class="mt-6 flex items-center justify-center gap-2 rounded-2xl border-2 border-slate-200 py-3 text-sm font-bold text-slate-600 transition hover:border-blue-400 hover:text-blue-600">
              <i data-lucide="bar-chart-3" class="h-4 w-4"></i>
              Lihat Nilai Siswa
            </a>

          </div>

        </div>

      @empty

        <div class="col-span-full flex flex-col items-center gap-3 rounded-3xl bg-white p-16 text-center shadow-sm shadow-slate-200/60">
          <i data-lucide="book-open" class="h-10 w-10 text-slate-300"></i>
          <p class="text-sm font-bold text-slate-400">Belum ada materi yang dibuat</p>
        </div>
      @endforelse

    </div>

  </div>

@endsection
