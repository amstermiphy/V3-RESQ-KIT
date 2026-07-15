@extends('layouts.siswa')

@section('title', 'Posko Siaga')

@section('content')

  <section class="min-h-screen bg-gradient-to-br from-sky-100 via-white to-cyan-100">

    <div class="mx-auto max-w-7xl px-6 py-10">

      {{-- Hero --}}
      <div class="relative overflow-hidden rounded-[40px] bg-gradient-to-r from-blue-500 via-sky-500 to-cyan-400 p-10 text-white shadow-2xl">

        <div class="absolute -right-20 -top-20 h-72 w-72 rounded-full bg-white/10"></div>
        <div class="absolute -left-10 bottom-0 h-56 w-56 rounded-full bg-white/10"></div>

        <div class="relative grid items-center gap-8 lg:grid-cols-2">

          <div>

            <span class="rounded-full bg-white/20 px-4 py-2 text-sm font-semibold">

              👋 Halo, {{ $siswa->nama }}!

            </span>

            <h1 class="mt-6 text-5xl font-black leading-tight">

              Selamat Datang di
              <br>
              Posko Siaga

            </h1>

            <p class="mt-5 max-w-lg text-lg text-blue-50">

              Aksa dan Reka sudah siap menemanimu belajar
              menghadapi berbagai bencana dengan cara yang seru.

            </p>

          </div>

          <div class="flex justify-center">

            <img src="{{ Vite::asset('resources/images/mascot/aksa.png') }}" class="h-72 rotate-[-6deg]">

            <img src="{{ Vite::asset('resources/images/mascot/reka.png') }}" class="-ml-10 h-72 rotate-[6deg]">

          </div>

        </div>

      </div>

      {{-- Progress --}}
      <div class="mt-8 rounded-3xl bg-white p-6 shadow-lg">

        <div class="flex justify-between">

          <h2 class="text-xl font-bold">

            Progress Belajar

          </h2>

          <span class="font-bold text-blue-600">

            {{ $persentaseProgress }}%

          </span>

        </div>

        <div class="mt-4 h-4 overflow-hidden rounded-full bg-slate-200">

          <div class="h-full rounded-full bg-blue-500 transition-all duration-700" style="width: {{ $persentaseProgress }}%"></div>

        </div>

        <p class="mt-2 text-sm text-slate-400">

          {{ $materiSelesai }} dari {{ $totalMateriAktif }} materi telah dipelajari.

        </p>

      </div>

      {{-- Menu --}}
      <div class="mt-10">

        <h2 class="mb-6 text-3xl font-black">

          Mau Ngapain Hari Ini? 🚀

        </h2>

        <div class="grid gap-6 md:grid-cols-2">

          {{-- Materi --}}
          <a href="/siswa/materi"
            class="group rounded-[30px] bg-white p-8 shadow-xl transition-all duration-300 hover:-translate-y-2 hover:bg-blue-600">

            <div class="text-6xl transition group-hover:scale-110">

              📚

            </div>

            <h3 class="mt-5 text-2xl font-black group-hover:text-white">

              Belajar Materi

            </h3>

            <p class="mt-3 text-slate-500 group-hover:text-blue-100">

              Kenali berbagai jenis bencana dan cara menyelamatkan diri.

            </p>

          </a>

          {{-- Petualangan --}}
          <a href="/siswa/simulasi"
            class="group rounded-[30px] bg-white p-8 shadow-xl transition-all duration-300 hover:-translate-y-2 hover:bg-green-500">

            <div class="text-6xl transition group-hover:scale-110">

              🎮

            </div>

            <h3 class="mt-5 text-2xl font-black group-hover:text-white">

              Mulai Petualangan

            </h3>

            <p class="mt-3 text-slate-500 group-hover:text-green-100">

              Main simulasi bersama Arduino dan kumpulkan skor terbaikmu.

            </p>

          </a>

          {{-- Prestasi
          <a href="#" class="group rounded-[30px] bg-white p-8 shadow-xl transition-all duration-300 hover:-translate-y-2 hover:bg-yellow-400">

            <div class="text-6xl transition group-hover:scale-110">

              🏅

            </div>

            <h3 class="mt-5 text-2xl font-black group-hover:text-white">

              Prestasi

            </h3>

            <p class="mt-3 text-slate-500 group-hover:text-yellow-50">

              Lihat badge dan pencapaian yang sudah kamu kumpulkan.

            </p>

          </a>

          Hasil
          <a href="#" class="group rounded-[30px] bg-white p-8 shadow-xl transition-all duration-300 hover:-translate-y-2 hover:bg-purple-500">

            <div class="text-6xl transition group-hover:scale-110">

              📊

            </div>

            <h3 class="mt-5 text-2xl font-black group-hover:text-white">

              Hasil Belajar

            </h3>

            <p class="mt-3 text-slate-500 group-hover:text-purple-100">

              Cek nilai dan perkembangan belajarmu.

            </p>

          </a> --}}

        </div>

      </div>

    </div>

  </section>

@endsection
