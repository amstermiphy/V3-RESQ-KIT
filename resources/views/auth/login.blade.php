@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')

  <section x-data="{ showPassword: false }"
    class="relative flex min-h-screen items-center justify-center overflow-hidden bg-gradient-to-br from-sky-100 via-white to-cyan-100 px-6 py-10">

    {{-- Background blobs --}}
    <div class="absolute inset-0">
      <div class="absolute -left-32 top-10 h-96 w-96 rounded-full bg-blue-200/40 blur-3xl"></div>
      <div class="absolute right-0 bottom-0 h-[450px] w-[450px] rounded-full bg-cyan-200/40 blur-3xl"></div>
      <div class="absolute left-1/2 top-1/2 h-[500px] w-[500px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-sky-100/40 blur-3xl"></div>
    </div>

    <div class="relative z-10 grid w-full max-w-4xl grid-cols-1 overflow-hidden rounded-[32px] bg-white/90 shadow-2xl backdrop-blur-md lg:grid-cols-2">

      {{-- KIRI: Ilustrasi / branding --}}
      <div class="hidden flex-col items-center justify-center gap-6 bg-gradient-to-br from-blue-500 to-cyan-500 p-10 text-center text-white lg:flex">

        <img src="{{ Vite::asset('resources/images/logo/logo.png') }}" class="h-30">

        <div>
          <h2 class="text-2xl font-black">
            Selamat Datang Guru Hebat!
          </h2>

          <p class="mt-2 text-sm text-white/80">
            Kelola kelas, pantau perkembangan belajar siswa, dan dampingi mereka mempelajari mitigasi bencana melalui RESQ-KIT.
          </p>
        </div>

        <div class="mt-4 flex">
          <img src="{{ Vite::asset('resources/images/mascot/aksa.png') }}"
            class="h-32 drop-shadow-xl transition duration-300 hover:-translate-y-2 hover:rotate-2">
          <img src="{{ Vite::asset('resources/images/mascot/reka.png') }}"
            class="h-32 drop-shadow-xl transition duration-300 hover:-translate-y-2 hover:-rotate-2">
        </div>

      </div>

      {{-- KANAN: Form login --}}
      <div class="flex flex-col justify-center p-8 sm:p-10">

        <div class="mb-2 flex items-center gap-3 lg:hidden">
          <img src="{{ Vite::asset('resources/images/logo/logo.png') }}" class="h-10">
          <span class="text-xl font-black text-slate-800">RESQ-KIT</span>
        </div>

        <h1 class="text-2xl font-black text-slate-800">Masuk sebagai Guru</h1>
        <p class="mt-1 text-sm text-slate-500">Masukkan akun untuk mengelola kelas dan memantau siswa.</p>

        {{-- Form --}}
        <form method="POST" action="{{ route('login') }}" class="mt-6 flex flex-col gap-4">
          @csrf

          {{-- Email --}}
          <div>
            <label for="email" class="mb-1.5 block text-sm font-bold text-slate-700">Email</label>
            <div class="relative">
              <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">✉️</span>
              <input id="email" name="email" type="email" required autofocus value="{{ old('email') }}" placeholder="nama@sekolah.id"
                class="w-full rounded-2xl border-2 border-slate-200 bg-white py-3 pl-11 pr-4 text-sm font-medium text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
            </div>
            @error('email')
              <p class="mt-1.5 text-xs font-semibold text-red-500">{{ $message }}</p>
            @enderror
          </div>

          {{-- Password --}}
          <div>
            <div class="mb-1.5 flex items-center justify-between">
              <label for="password" class="block text-sm font-bold text-slate-700">Kata Sandi</label>
              <a href="#" class="text-xs font-bold text-blue-600 hover:underline">Lupa kata sandi?</a>
            </div>
            <div class="relative">
              <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">🔒</span>
              <input :type="showPassword ? 'text' : 'password'" id="password" name="password" required placeholder="••••••••"
                class="w-full rounded-2xl border-2 border-slate-200 bg-white py-3 pl-11 pr-11 text-sm font-medium text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
              <button type="button" @click="showPassword = !showPassword"
                class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-slate-600">
                <span x-text="showPassword ? '🙈' : '👁️'"></span>
              </button>
            </div>
            @error('password')
              <p class="mt-1.5 text-xs font-semibold text-red-500">{{ $message }}</p>
            @enderror
          </div>

          {{-- Remember me --}}
          <label class="flex items-center gap-2 text-sm font-semibold text-slate-600">
            <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-400">
            Ingat saya
          </label>

          {{-- Submit --}}
          <button type="submit"
            class="mt-2 w-full rounded-2xl bg-emerald-600 py-3.5 text-sm font-black text-white shadow-lg transition-all duration-200 hover:scale-[1.01] hover:bg-emerald-700 active:scale-[.98]">
            📋 Masuk sebagai Guru
          </button>

        </form>

        <p class="mt-6 text-center text-sm text-slate-500">
          Siswa tidak perlu akun.
          <a href="/identitas" class="font-black text-blue-600 hover:underline">Mulai belajar di sini</a>
        </p>

        <p class="mt-2 text-center text-sm text-slate-500">
          Belum punya akun guru?
          <a href="{{ route('register') }}" class="font-black text-blue-600 hover:underline">Daftar di sini</a>
        </p>

        <a href="/" class="mt-4 text-center text-xs font-bold text-slate-400 hover:text-slate-600">
          ← Kembali ke beranda
        </a>

      </div>

    </div>

  </section>

@endsection
