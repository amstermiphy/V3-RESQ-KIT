{{-- ================= SIDEBAR GURU ================= --}}
<aside class="flex w-72 shrink-0 flex-col overflow-y-auto bg-gradient-to-b from-blue-600 to-blue-500 px-5 py-6 text-white">

  {{-- Logo --}}
  <div class="flex items-center gap-3 px-1">
    <img src="{{ Vite::asset('resources/images/logo/logo.png') }}" class="h-10 w-10 rounded-xl bg-white/90 p-1" alt="Logo RESQ-KIT">
    <div>
      <h1 class="text-xl font-black tracking-tight">RESQ-KIT</h1>
      <p class="text-[11px] font-semibold uppercase tracking-wider text-white/70">Belajar &bull; Siap &bull; Selamat</p>
    </div>
  </div>

  {{-- Ilustrasi maskot --}}
  <div class="relative mt-5 flex h-32 items-end justify-center overflow-hidden rounded-3xl bg-white/10">
    <div class="absolute -left-6 -top-6 h-24 w-24 rounded-full bg-white/10"></div>
    <div class="absolute -right-8 -bottom-8 h-28 w-28 rounded-full bg-white/10"></div>
    <img src="{{ Vite::asset('resources/images/mascot/aksa.png') }}" class="relative z-10 h-28 -mr-2 drop-shadow-lg" alt="Aska">
    <img src="{{ Vite::asset('resources/images/mascot/reka.png') }}" class="relative z-10 h-28 drop-shadow-lg" alt="Reka">
  </div>

  {{-- Kartu kelas --}}
  <div class="mt-5 rounded-2xl bg-white p-4 text-slate-700 shadow-lg">

    <div class="flex items-center gap-3">
      <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-xl">
        🏫
      </div>
      <div>
        <p class="text-sm font-black leading-tight">{{ auth()->user()->kelas->nama ?? 'Kelas 4A' }}</p>
        <p class="text-xs text-slate-400">{{ auth()->user()->sekolah->nama ?? 'SDN 1 Cerdas' }}</p>
      </div>
    </div>

    <div class="mt-3">
      <div class="mb-1 flex items-center justify-between text-[11px] font-bold text-slate-400">
        <span>Progress Kelas</span>
        <span class="text-slate-600">{{ $progressKelas ?? 72 }}%</span>
      </div>
      <div class="h-2 w-full rounded-full bg-slate-100">
        <div class="h-2 rounded-full bg-gradient-to-r from-blue-500 to-cyan-400" style="width: {{ $progressKelas ?? 72 }}%"></div>
      </div>
    </div>

  </div>

  {{-- Menu navigasi --}}
  <nav class="mt-6 flex flex-1 flex-col gap-1.5">

    @php
      $menu = [
          ['label' => 'Dashboard', 'icon' => 'home', 'route' => 'guru.dashboard'],
          ['label' => 'Siswa', 'icon' => 'users', 'route' => 'guru.siswa'],
          ['label' => 'Materi', 'icon' => 'book-open', 'route' => 'guru.materi'],
          // ['label' => 'Simulasi', 'icon' => 'gamepad-2', 'route' => 'guru.simulasi'],
          ['label' => 'Penilaian', 'icon' => 'clipboard-list', 'route' => 'guru.penilaian'],
          ['label' => 'Laporan', 'icon' => 'bar-chart-3', 'route' => 'guru.laporan'],
          // ['label' => 'Pengaturan', 'icon' => 'settings', 'route' => 'guru.pengaturan'],
      ];
    @endphp

    @foreach ($menu as $item)
      @php $active = request()->routeIs($item['route']); @endphp

      <a href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}"
        class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-bold transition-all duration-200 {{ $active ? 'bg-white text-blue-600 shadow-md' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
        <i data-lucide="{{ $item['icon'] }}" class="h-5 w-5"></i>
        {{ $item['label'] }}
      </a>
    @endforeach

  </nav>

  {{-- Status Arduino --}}
  <div class="mt-2 flex items-center justify-between rounded-2xl bg-white/10 px-4 py-3">
    <div>
      <p class="text-[11px] font-bold uppercase tracking-wide text-white/60">Status Arduino</p>
      <p class="flex items-center gap-1.5 text-sm font-bold text-white">
        <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
        Terhubung
      </p>
    </div>
    <span class="text-2xl">🔌</span>
  </div>

</aside>
