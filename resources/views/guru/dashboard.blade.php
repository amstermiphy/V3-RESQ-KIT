@extends('layouts.guru')

@section('title', 'Dashboard')

@section('content')

  <div class="flex flex-col gap-5">

    {{-- ============== CARD STATISTIK ============== --}}
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">

      @php
        $statistik = [
            [
                'label' => 'Total Siswa',
                'value' => $totalSiswa ?? 28,
                'desc' => 'Siswa terdaftar',
                'icon' => 'users',
                'bg' => 'bg-blue-50',
                'fg' => 'text-blue-500',
            ],
            [
                'label' => 'Materi Aktif',
                'value' => $materiAktif ?? 12,
                'desc' => 'Materi tersedia',
                'icon' => 'book-open',
                'bg' => 'bg-emerald-50',
                'fg' => 'text-emerald-500',
            ],
            [
                'label' => 'Simulasi Hari Ini',
                'value' => $simulasiHariIni ?? 3,
                'desc' => 'Sesi simulasi',
                'icon' => 'gamepad-2',
                'bg' => 'bg-amber-50',
                'fg' => 'text-amber-500',
            ],
            [
                'label' => 'Rata-rata Nilai',
                'value' => $rataNilai ?? 85,
                'desc' => 'Minggu ini',
                'icon' => 'trophy',
                'bg' => 'bg-violet-50',
                'fg' => 'text-violet-500',
            ],
        ];
      @endphp

      @foreach ($statistik as $s)
        <div
          class="flex items-center gap-4 rounded-3xl bg-white p-5 shadow-sm shadow-slate-200/60 transition duration-300 hover:-translate-y-1 hover:shadow-lg">

          <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl {{ $s['bg'] }} {{ $s['fg'] }}">
            <i data-lucide="{{ $s['icon'] }}" class="h-7 w-7"></i>
          </div>

          <div>
            <p class="text-sm font-bold text-slate-500">{{ $s['label'] }}</p>
            <p class="text-2xl font-black text-slate-800">{{ $s['value'] }}</p>
            <p class="text-xs text-slate-400">{{ $s['desc'] }}</p>
          </div>

        </div>
      @endforeach

    </div>

    {{-- ============== GRAFIK + AKTIVITAS + ARDUINO ============== --}}
    <div x-data="{ rentang: 'Minggu Ini', rentangOpen: false }" class="grid grid-cols-1 gap-5 xl:grid-cols-12">

      {{-- Grafik --}}
      <div class="rounded-3xl bg-white p-6 shadow-sm shadow-slate-200/60 xl:col-span-6">

        <div class="flex items-center justify-between">
          <h3 class="text-base font-black text-slate-800">Grafik Perkembangan Kelas</h3>

          <div class="relative">
            <button type="button" @click="rentangOpen = !rentangOpen"
              class="flex items-center gap-2 rounded-full border border-slate-200 px-4 py-1.5 text-xs font-bold text-slate-600 transition hover:bg-slate-50">
              <span x-text="rentang"></span>
              <i data-lucide="chevron-down" class="h-3.5 w-3.5"></i>
            </button>

            <div x-show="rentangOpen" @click.outside="rentangOpen = false" x-transition
              class="absolute right-0 z-20 mt-2 w-40 rounded-2xl border border-slate-100 bg-white p-1.5 shadow-xl" style="display: none;">
              <button type="button" @click="rentang = 'Minggu Ini'; rentangOpen = false"
                class="block w-full rounded-xl px-3 py-2 text-left text-xs font-semibold text-slate-600 hover:bg-slate-50">Minggu Ini</button>
              <button type="button" @click="rentang = 'Bulan Ini'; rentangOpen = false"
                class="block w-full rounded-xl px-3 py-2 text-left text-xs font-semibold text-slate-600 hover:bg-slate-50">Bulan Ini</button>
              <button type="button" @click="rentang = 'Semester Ini'; rentangOpen = false"
                class="block w-full rounded-xl px-3 py-2 text-left text-xs font-semibold text-slate-600 hover:bg-slate-50">Semester Ini</button>
            </div>
          </div>
        </div>

        <div class="relative mt-4 h-72">
          <canvas id="grafikKelas"></canvas>
        </div>

      </div>

      {{-- Aktivitas terbaru --}}
      <div class="rounded-3xl bg-white p-6 shadow-sm shadow-slate-200/60 xl:col-span-3">

        <h3 class="text-base font-black text-slate-800">Aktivitas Terbaru</h3>

        <div class="mt-4 flex flex-col gap-4">

          @php
            $aktivitas = $aktivitasTerbaru ?? [
                [
                    'nama' => 'Andi',
                    'aksi' => 'menyelesaikan simulasi',
                    'objek' => 'Gempa Bumi',
                    'waktu' => '10 menit lalu',
                    'avatar' => 'aksa',
                    'status' => 'sukses',
                ],
                [
                    'nama' => 'Siti',
                    'aksi' => 'mengerjakan kuis',
                    'objek' => 'Kebakaran',
                    'waktu' => '25 menit lalu',
                    'avatar' => 'reka',
                    'status' => 'sukses',
                ],
                [
                    'nama' => 'Budi',
                    'aksi' => 'mendapatkan badge',
                    'objek' => 'Penyelamat Hebat',
                    'waktu' => '1 jam lalu',
                    'avatar' => 'aksa',
                    'status' => 'badge',
                ],
                [
                    'nama' => 'Dewi',
                    'aksi' => 'menyelesaikan materi',
                    'objek' => 'Banjir',
                    'waktu' => '2 jam lalu',
                    'avatar' => 'reka',
                    'status' => 'sukses',
                ],
            ];
          @endphp

          @foreach ($aktivitas as $a)
            <div class="flex items-center gap-3.5">

              <img src="{{ Vite::asset('resources/images/mascot/' . $a['avatar'] . '.png') }}"
                class="h-11 w-11 shrink-0 rounded-full bg-slate-50 object-contain p-1" alt="{{ $a['nama'] }}">

              <div class="min-w-0 flex-1">
                <p class="truncate text-sm font-bold text-slate-700">
                  {{ $a['nama'] }} <span class="font-medium text-slate-400">{{ $a['aksi'] }}</span> {{ $a['objek'] }}
                </p>
                <p class="text-xs text-slate-400">{{ $a['waktu'] }}</p>
              </div>

              <span
                class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full {{ $a['status'] === 'badge' ? 'bg-amber-50 text-amber-500' : 'bg-emerald-50 text-emerald-500' }}">
                <i data-lucide="{{ $a['status'] === 'badge' ? 'star' : 'check' }}" class="h-4 w-4"></i>
              </span>

            </div>
          @endforeach

        </div>

        <a href="#" class="mt-5 block text-center text-sm font-bold text-blue-600 transition hover:underline">
          Lihat semua aktivitas
        </a>

      </div>

      {{-- Status Arduino --}}
      @php $arduinoOnline = $arduinoOnline ?? true; @endphp

      <div class="flex flex-col rounded-3xl bg-white p-6 shadow-sm shadow-slate-200/60 xl:col-span-3">

        <div class="flex items-center justify-between">
          <h3 class="text-base font-black text-slate-800">Status Arduino</h3>
          <span
            class="flex items-center gap-1.5 rounded-full {{ $arduinoOnline ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-500' }} px-3 py-1 text-xs font-bold">
            <span class="h-1.5 w-1.5 rounded-full {{ $arduinoOnline ? 'bg-emerald-500' : 'bg-red-500' }}"></span>
            {{ $arduinoOnline ? 'Online' : 'Offline' }}
          </span>
        </div>

        <div class="my-5 flex items-center justify-center rounded-2xl bg-emerald-50/60 py-6">
          <img src="{{ Vite::asset('resources/images/mascot/arduino.png') }}" class="h-24 w-24 object-contain"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'" alt="Arduino RESQ-KIT">
          <div style="display:none" class="hidden h-24 w-24 items-center justify-center rounded-full bg-emerald-100 text-4xl">
            🧩
          </div>
        </div>

        <div class="flex flex-col gap-3 text-sm">

          <div class="flex items-center justify-between">
            <span class="text-slate-400">Port</span>
            <span class="font-bold text-slate-700">{{ $arduinoPort ?? 'COM4' }}</span>
          </div>

          <div class="flex items-center justify-between">
            <span class="text-slate-400">Baudrate</span>
            <span class="font-bold text-slate-700">{{ $arduinoBaudrate ?? '9600' }}</span>
          </div>

          <div class="flex items-center justify-between">
            <span class="text-slate-400">Terakhir diterima</span>
            <span class="font-bold text-slate-700">{{ $arduinoTerakhir ?? 'Hari ini, 09:23:15' }}</span>
          </div>

        </div>

        <button type="button"
          class="mt-6 w-full rounded-2xl bg-emerald-600 py-3 text-sm font-black text-white shadow-lg shadow-emerald-200 transition hover:bg-emerald-700">
          Lihat Detail
        </button>

      </div>

    </div>

  </div>

@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {

      const ctx = document.getElementById('grafikKelas');
      if (!ctx) return;

      const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 260);
      gradient.addColorStop(0, 'rgba(37, 99, 235, 0.25)');
      gradient.addColorStop(1, 'rgba(37, 99, 235, 0)');

      @php
        // Disiapkan dulu di sini, bukan langsung di dalam @json,
        // karena @json() memecah argumen pakai explode(','), jadi
        // koma di dalam array literal bikin bracket-nya kepotong.
        $labelHariGrafik = $labelHari ?? ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
        $dataNilaiGrafik = $dataNilaiMingguan ?? [65, 72, 80, 68, 82, 78, 88];
      @endphp

      new Chart(ctx, {
        type: 'line',
        data: {
          labels: @json($labelHariGrafik),
          datasets: [{
            label: 'Rata-rata Nilai',
            data: @json($dataNilaiGrafik),
            borderColor: '#2563EB',
            backgroundColor: gradient,
            borderWidth: 3,
            pointBackgroundColor: '#FFFFFF',
            pointBorderColor: '#2563EB',
            pointBorderWidth: 2,
            pointRadius: 5,
            pointHoverRadius: 7,
            tension: 0.4,
            fill: true,
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false
            },
            tooltip: {
              backgroundColor: '#1E293B',
              padding: 12,
              cornerRadius: 12,
              titleFont: {
                weight: 'bold'
              },
              callbacks: {
                label: (item) => `${item.formattedValue}%`
              }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              max: 100,
              ticks: {
                stepSize: 25,
                color: '#94A3B8'
              },
              grid: {
                color: '#F1F5F9'
              }
            },
            x: {
              ticks: {
                color: '#94A3B8'
              },
              grid: {
                display: false
              }
            }
          }
        }
      });

    });
  </script>
@endpush
