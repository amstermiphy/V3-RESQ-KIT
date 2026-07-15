{{-- ================= NAVBAR GURU ================= --}}
<header x-data="{ profileOpen: false }" class="flex items-center justify-between gap-6 border-b border-slate-100 bg-white px-6 py-4">

  <div>
    <h2 class="text-lg font-black text-slate-800">
      Selamat datang, {{ optional(auth()->user())->nama ?? 'Bu Guru' }}! 👋
    </h2>
    <p class="text-sm text-slate-400">
      Pantau pembelajaran dan perkembangan siswa hari ini.
    </p>
  </div>

  <div class="flex flex-1 items-center justify-end gap-4">

    {{-- Search --}}
    <div class="relative hidden w-full max-w-xs md:block">
      <i data-lucide="search" class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"></i>
      <input type="text" placeholder="Cari sesuatu..."
        class="w-full rounded-full border border-slate-200 bg-slate-50 py-2.5 pl-11 pr-14 text-sm font-medium text-slate-600 outline-none transition focus:border-blue-400 focus:bg-white focus:ring-4 focus:ring-blue-50">
      <kbd
        class="absolute right-3 top-1/2 -translate-y-1/2 rounded-md bg-white px-1.5 py-0.5 text-[10px] font-bold text-slate-400 shadow-sm ring-1 ring-slate-200">
        Ctrl K
      </kbd>
    </div>

    {{-- Notifikasi --}}
    <button type="button"
      class="relative flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-slate-50 text-slate-500 transition hover:bg-slate-100">
      <i data-lucide="bell" class="h-5 w-5"></i>
      @if (($jumlahNotifikasi ?? 0) > 0)
        <span
          class="absolute -right-1 -top-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-[10px] font-black text-white ring-2 ring-white">
          {{ $jumlahNotifikasi }}
        </span>
      @endif
    </button>

    {{-- Toggle tema --}}
    <button type="button"
      class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-slate-50 text-slate-500 transition hover:bg-slate-100">
      <i data-lucide="sun" class="h-5 w-5"></i>
    </button>

    {{-- Profil --}}
    <div class="relative">

      <button type="button" @click="profileOpen = !profileOpen"
        class="flex items-center gap-2.5 rounded-full py-1 pl-1 pr-3 transition hover:bg-slate-50">
        <img src="{{ optional(auth()->user())->foto ?? Vite::asset('resources/images/mascot/reka.png') }}"
          class="h-9 w-9 rounded-full object-cover ring-2 ring-blue-100" alt="Foto profil">
        <span class="text-sm font-bold text-slate-700">{{ optional(auth()->user())->nama ?? 'Bu Guru' }}</span>
        <i data-lucide="chevron-down" class="h-4 w-4 text-slate-400"></i>
      </button>

      <div x-show="profileOpen" @click.outside="profileOpen = false" x-transition
        class="absolute right-0 z-50 mt-2 w-52 rounded-2xl border border-slate-100 bg-white p-2 shadow-xl" style="display: none;">

        <a href="#" class="flex items-center gap-2.5 rounded-xl px-3 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
          <i data-lucide="user" class="h-4 w-4"></i> Profil Saya
        </a>
        <a href="#" class="flex items-center gap-2.5 rounded-xl px-3 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
          <i data-lucide="settings" class="h-4 w-4"></i> Pengaturan
        </a>
        <hr class="my-1.5 border-slate-100">
        {{-- Diaktifkan lagi setelah route 'logout' guru dibuat --}}
        {{-- <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit"
            class="flex w-full items-center gap-2.5 rounded-xl px-3 py-2.5 text-sm font-semibold text-red-500 transition hover:bg-red-50">
            <i data-lucide="log-out" class="h-4 w-4"></i> Keluar
          </button>
        </form> --}}

      </div>

    </div>

  </div>

</header>
