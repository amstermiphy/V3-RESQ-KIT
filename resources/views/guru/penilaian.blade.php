@extends('layouts.guru')

@section('title', 'Penilaian')

@section('content')

  <div class="flex flex-col gap-5">

    {{-- ============== HEADER + FILTER ============== --}}
    <div class="flex flex-col gap-4 rounded-3xl bg-white p-6 shadow-sm shadow-slate-200/60">

      <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
        <div>
          <h2 class="text-lg font-black text-slate-800">Penilaian Simulasi</h2>
          <p class="text-sm text-slate-400">Hasil simulasi siswa dari mode digital & RESQ-KIT</p>
        </div>

        <span class="w-fit rounded-full bg-blue-50 px-4 py-2 text-xs font-bold text-blue-600">
          {{ $hasil->total() }} total hasil
        </span>
      </div>

      <form method="GET" action="{{ route('guru.penilaian') }}" class="flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-center">

        <select name="materi_id" onchange="this.form.submit()"
          class="rounded-2xl border border-slate-200 px-4 py-2.5 text-sm font-bold text-slate-600 focus:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-100">
          <option value="">Semua Materi</option>
          @foreach ($materi as $m)
            <option value="{{ $m->id }}" @selected(request('materi_id') == $m->id)>
              {{ $m->judul }}
            </option>
          @endforeach
        </select>

        <select name="mode" onchange="this.form.submit()"
          class="rounded-2xl border border-slate-200 px-4 py-2.5 text-sm font-bold text-slate-600 focus:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-100">
          <option value="">Semua Mode</option>
          <option value="digital" @selected(request('mode') === 'digital')>Digital</option>
          <option value="arduino" @selected(request('mode') === 'arduino')>RESQ-KIT</option>
        </select>

        <select name="status" onchange="this.form.submit()"
          class="rounded-2xl border border-slate-200 px-4 py-2.5 text-sm font-bold text-slate-600 focus:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-100">
          <option value="">Semua Status</option>
          <option value="selesai" @selected(request('status') === 'selesai')>Selesai</option>
          <option value="proses" @selected(request('status') === 'proses')>Proses</option>
          <option value="belum" @selected(request('status') === 'belum')>Belum</option>
          <option value="gagal" @selected(request('status') === 'gagal')>Gagal</option>
        </select>

        @if (request('materi_id') || request('mode') || request('status'))
          <a href="{{ route('guru.penilaian') }}" class="text-sm font-bold text-slate-400 transition hover:text-slate-600">
            Reset Filter
          </a>
        @endif

      </form>

    </div>

    {{-- ============== TABEL PENILAIAN ============== --}}
    <div class="overflow-hidden rounded-3xl bg-white shadow-sm shadow-slate-200/60">

      <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">

          <thead>
            <tr class="border-b border-slate-100 bg-slate-50/60 text-xs font-black uppercase tracking-wide text-slate-400">
              <th class="px-6 py-4">Siswa</th>
              <th class="px-6 py-4">Kelas</th>
              <th class="px-6 py-4">Materi</th>
              <th class="px-6 py-4">Mode</th>
              <th class="px-6 py-4">Skor</th>
              <th class="px-6 py-4">Durasi</th>
              <th class="px-6 py-4">Status</th>
              <th class="px-6 py-4">Tanggal</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-slate-100">

            @forelse ($hasil as $h)
              @php
                $avatar = ($h->siswa->jenis_kelamin ?? null) === 'P' ? 'reka' : 'aksa';
                $menit = intdiv($h->durasi, 60);
                $detik = $h->durasi % 60;
              @endphp

              <tr class="transition hover:bg-slate-50/60">

                <td class="px-6 py-4">
                  <div class="flex items-center gap-3">
                    <img src="{{ Vite::asset('resources/images/mascot/' . $avatar . '.png') }}"
                      class="h-9 w-9 shrink-0 rounded-full bg-slate-50 object-contain p-1" alt="{{ $h->siswa->nama ?? '-' }}">
                    <span class="font-bold text-slate-700">{{ $h->siswa->nama ?? '-' }}</span>
                  </div>
                </td>

                <td class="px-6 py-4">
                  <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-bold text-blue-600">
                    {{ $h->siswa->kelas->nama_kelas ?? '-' }}
                  </span>
                </td>

                <td class="px-6 py-4">
                  <span class="flex items-center gap-1.5 font-medium text-slate-600">
                    <span>{{ $h->materi->icon ?? '📘' }}</span>
                    {{ $h->materi->judul ?? '-' }}
                  </span>
                </td>

                <td class="px-6 py-4">
                  <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-600">
                    {{ $h->mode === 'arduino' ? '🧩 RESQ-KIT' : '💻 Digital' }}
                  </span>
                </td>

                <td class="px-6 py-4">
                  @if ($h->status === 'selesai')
                    <span
                      class="rounded-full px-3 py-1 text-xs font-black
                        {{ $h->skor >= 80 ? 'bg-emerald-50 text-emerald-600' : ($h->skor >= 60 ? 'bg-amber-50 text-amber-600' : 'bg-red-50 text-red-500') }}">
                      {{ $h->skor }}
                    </span>
                  @else
                    <span class="text-xs font-medium text-slate-300">-</span>
                  @endif
                </td>

                <td class="px-6 py-4 text-slate-500">
                  @if ($h->durasi > 0)
                    {{ $menit }}m {{ $detik }}d
                  @else
                    <span class="text-slate-300">-</span>
                  @endif
                </td>

                <td class="px-6 py-4">
                  <span
                    class="rounded-full px-2.5 py-1 text-xs font-black
                    {{ match ($h->status) {
                        'selesai' => 'bg-emerald-50 text-emerald-600',
                        'proses' => 'bg-amber-50 text-amber-600',
                        'gagal' => 'bg-red-50 text-red-500',
                        default => 'bg-slate-100 text-slate-400',
                    } }}">
                    {{ ucfirst($h->status) }}
                  </span>
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-slate-400">
                  {{ $h->created_at->format('d M Y, H:i') }}
                </td>

              </tr>

            @empty

              <tr>
                <td colspan="8" class="px-6 py-16 text-center">
                  <div class="flex flex-col items-center gap-3">
                    <i data-lucide="clipboard-list" class="h-10 w-10 text-slate-300"></i>
                    <p class="text-sm font-bold text-slate-400">Belum ada hasil simulasi yang cocok</p>
                  </div>
                </td>
              </tr>
            @endforelse

          </tbody>

        </table>
      </div>

      @if ($hasil->hasPages())
        <div class="border-t border-slate-100 px-6 py-4">
          {{ $hasil->appends(request()->query())->links() }}
        </div>
      @endif

    </div>

  </div>

@endsection
