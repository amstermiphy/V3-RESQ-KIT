@extends('layouts.auth')

@section('title', 'Daftar')

@section('content')

  <section x-data="{ showPassword: false, showPasswordConfirm: false }"
    class="relative flex h-screen items-center justify-center overflow-hidden bg-gradient-to-br from-sky-100 via-white to-cyan-100 px-6 py-4">

    {{-- Background blobs --}}
    <div class="absolute inset-0">
      <div class="absolute -left-32 top-10 h-96 w-96 rounded-full bg-blue-200/40 blur-3xl"></div>
      <div class="absolute right-0 bottom-0 h-[450px] w-[450px] rounded-full bg-cyan-200/40 blur-3xl"></div>
      <div class="absolute left-1/2 top-1/2 h-[500px] w-[500px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-sky-100/40 blur-3xl"></div>
    </div>

    <div
      class="relative z-10 grid w-full max-w-4xl grid-cols-1 overflow-hidden rounded-[32px] bg-white/90 shadow-2xl backdrop-blur-md lg:grid-cols-2 max-h-[95vh]">

      {{-- KIRI: Ilustrasi / branding --}}
      <div class="hidden flex-col items-center justify-center gap-4 bg-gradient-to-br from-blue-500 to-cyan-500 p-8 text-center text-white lg:flex">

        <img src="{{ Vite::asset('resources/images/logo/logo.png') }}" class="h-20">

        <div>
          <h2 class="text-xl font-black">
            Gabung Jadi Guru RESQ-KIT!
          </h2>

          <p class="mt-2 text-sm text-white/80">
            Buat akun untuk mengelola kelas, pantau perkembangan siswa, dan dampingi mereka belajar mitigasi bencana bersama Aksa dan Reka.
          </p>
        </div>

        <div class="mt-2 flex">
          <img src="{{ Vite::asset('resources/images/mascot/aksa.png') }}"
            class="h-20 drop-shadow-xl transition duration-300 hover:-translate-y-2 hover:rotate-2">
          <img src="{{ Vite::asset('resources/images/mascot/reka.png') }}"
            class="h-20 drop-shadow-xl transition duration-300 hover:-translate-y-2 hover:-rotate-2">
        </div>

      </div>

      {{-- KANAN: Form register --}}
      <div class="flex flex-col justify-center overflow-y-auto p-6 sm:p-8">

        <div class="mb-1 flex items-center gap-3 lg:hidden">
          <img src="{{ Vite::asset('resources/images/logo/logo.png') }}" class="h-8">
          <span class="text-lg font-black text-slate-800">RESQ-KIT</span>
        </div>

        <h1 class="text-xl font-black text-slate-800">Daftar sebagai Guru</h1>
        <p class="mt-1 text-sm text-slate-500">Buat akun baru untuk mulai mengelola kelas.</p>

        {{-- Form --}}
        <form method="POST" action="{{ route('register') }}" class="mt-4 flex flex-col gap-3">
          @csrf

          {{-- Fullname --}}
          <div>
            <label for="fullname" class="mb-1 block text-sm font-bold text-slate-700">Nama Lengkap</label>
            <input id="fullname" name="fullname" type="text" required autofocus value="{{ old('fullname') }}" placeholder="Nama lengkap kamu"
              class="w-full rounded-xl border-2 border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
            @error('fullname')
              <p class="mt-1 text-xs font-semibold text-red-500">{{ $message }}</p>
            @enderror
          </div>

          {{-- Username & Email side by side --}}
          <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
            <div>
              <label for="username" class="mb-1 block text-sm font-bold text-slate-700">Username</label>
              <input id="username" name="username" type="text" required value="{{ old('username') }}" placeholder="username_guru"
                class="w-full rounded-xl border-2 border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
              @error('username')
                <p class="mt-1 text-xs font-semibold text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="email" class="mb-1 block text-sm font-bold text-slate-700">Email</label>
              <input id="email" name="email" type="email" required value="{{ old('email') }}" placeholder="nama@sekolah.id"
                class="w-full rounded-xl border-2 border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
              @error('email')
                <p class="mt-1 text-xs font-semibold text-red-500">{{ $message }}</p>
              @enderror
            </div>
          </div>

          {{-- Password & Confirmation side by side --}}
          <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
            <div>
              <label for="password" class="mb-1 block text-sm font-bold text-slate-700">Kata Sandi</label>
              <div class="relative">
                <input :type="showPassword ? 'text' : 'password'" id="password" name="password" required placeholder="Min. 8 karakter"
                  class="w-full rounded-xl border-2 border-slate-200 bg-white px-4 py-2.5 pr-11 text-sm font-medium text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                <button type="button" @click="showPassword = !showPassword"
                  class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-slate-600">
                  <span x-text="showPassword ? '🙈' : '👁️'"></span>
                </button>
              </div>
              @error('password')
                <p class="mt-1 text-xs font-semibold text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="password_confirmation" class="mb-1 block text-sm font-bold text-slate-700">Konfirmasi Sandi</label>
              <div class="relative">
                <input :type="showPasswordConfirm ? 'text' : 'password'" id="password_confirmation" name="password_confirmation" required
                  placeholder="Ulangi sandi"
                  class="w-full rounded-xl border-2 border-slate-200 bg-white px-4 py-2.5 pr-11 text-sm font-medium text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                <button type="button" @click="showPasswordConfirm = !showPasswordConfirm"
                  class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-slate-600">
                  <span x-text="showPasswordConfirm ? '🙈' : '👁️'"></span>
                </button>
              </div>
            </div>
          </div>

          {{-- Submit --}}
          <button type="submit"
            class="mt-2 w-full rounded-xl bg-emerald-600 py-3 text-sm font-black text-white shadow-lg transition-all duration-200 hover:scale-[1.01] hover:bg-emerald-700 active:scale-[.98]">
            Daftar sebagai Guru
          </button>

        </form>

        <p class="mt-4 text-center text-sm text-slate-500">
          Sudah punya akun?
          <a href="{{ route('login') }}" class="font-black text-blue-600 hover:underline">Masuk di sini</a>
        </p>

        <a href="/" class="mt-2 text-center text-xs font-bold text-slate-400 hover:text-slate-600">
          ← Kembali ke beranda
        </a>

      </div>

    </div>

  </section>

@endsection
