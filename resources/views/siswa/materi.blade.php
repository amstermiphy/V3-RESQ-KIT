@extends('layouts.siswa')

@section('title', 'Materi')

@section('content')

  <section class="relative min-h-screen overflow-hidden bg-gradient-to-br from-sky-100 via-white to-cyan-100">

    {{-- Background --}}
    <div class="absolute inset-0">

      <div class="absolute -left-32 top-10 h-96 w-96 rounded-full bg-blue-200/40 blur-3xl"></div>

      <div class="absolute right-0 bottom-0 h-[450px] w-[450px] rounded-full bg-cyan-200/40 blur-3xl"></div>

    </div>

    <div class="relative z-10 mx-auto max-w-7xl px-6 py-10">

      {{-- Header --}}
      <div class="flex items-center justify-between">

        <div>

          <a href="/siswa/home"
            class="inline-flex items-center gap-2 rounded-2xl border-2 border-slate-300 px-6 py-3 font-bold text-slate-600 transition hover:bg-slate-100">

            ← Kembali

          </a>

          <h1 class="mt-5 text-5xl font-black text-slate-800">

            📚 Pusat Materi

          </h1>

          <p class="mt-3 text-lg text-slate-500">

            Yuk belajar dulu sebelum memulai petualangan!

          </p>

        </div>

        <img src="{{ Vite::asset('resources/images/mascot/reka.png') }}" class="h-36">

      </div>

      {{-- Progress --}}
      <div class="mt-10 rounded-[30px] bg-white p-8 shadow-xl">

        <div class="flex items-center justify-between">

          <div>

            <h2 class="text-2xl font-black">

              Progress Belajar

            </h2>

            <p class="text-slate-500">

              2 dari 5 materi telah dipelajari.

            </p>

          </div>

          <span class="rounded-full bg-blue-100 px-6 py-3 font-bold text-blue-600">

            40%

          </span>

        </div>

        <div class="mt-6 h-4 overflow-hidden rounded-full bg-slate-200">

          <div class="h-full w-2/5 rounded-full bg-blue-600"></div>

        </div>

      </div>

      {{-- Card Materi --}}
      <div class="mt-10 grid gap-8 md:grid-cols-2 xl:grid-cols-3">

        {{-- Gempa --}}
        <div class="group overflow-hidden rounded-[35px] bg-white shadow-xl transition duration-300 hover:-translate-y-2 hover:shadow-2xl">

          <div class="bg-gradient-to-r from-orange-400 to-red-500 p-8 text-center text-white">

            <div class="text-7xl">

              🌍

            </div>

            <h2 class="mt-4 text-3xl font-black">

              Gempa Bumi

            </h2>

          </div>

          <div class="p-8">

            <p class="text-slate-600">

              Belajar apa yang harus dilakukan ketika terjadi gempa bumi.

            </p>

            <div class="mt-6 flex items-center justify-between">

              <span class="rounded-full bg-green-100 px-4 py-2 text-sm font-bold text-green-700">

                ⭐ Mudah

              </span>

              <span class="font-bold text-blue-600">

                10 Menit

              </span>

            </div>

            <a href="/siswa/materi/gempa"
              class="mt-8 block w-full rounded-2xl bg-orange-500 py-4 text-center font-bold text-white transition hover:bg-orange-600">

              📖 Belajar

            </a>

          </div>

        </div>

        {{-- Banjir --}}
        <div class="group overflow-hidden rounded-[35px] bg-white shadow-xl transition duration-300 hover:-translate-y-2 hover:shadow-2xl">

          <div class="bg-gradient-to-r from-blue-500 to-cyan-500 p-8 text-center text-white">

            <div class="text-7xl">

              🌊

            </div>

            <h2 class="mt-4 text-3xl font-black">

              Banjir

            </h2>

          </div>

          <div class="p-8">

            <p class="text-slate-600">

              Pelajari cara menghadapi banjir dengan aman.

            </p>

            <div class="mt-6 flex items-center justify-between">

              <span class="rounded-full bg-green-100 px-4 py-2 text-sm font-bold text-green-700">

                ⭐ Mudah

              </span>

              <span class="font-bold text-blue-600">

                8 Menit

              </span>

            </div>

            <a href="/siswa/materi/banjir"
              class="mt-8 block w-full rounded-2xl bg-blue-600 py-4 text-center font-bold text-white transition hover:bg-blue-700">

              📖 Belajar

            </a>

          </div>

        </div>

        {{-- Kebakaran --}}
        <div class="group overflow-hidden rounded-[35px] bg-white shadow-xl transition duration-300 hover:-translate-y-2 hover:shadow-2xl">

          <div class="bg-gradient-to-r from-red-500 to-pink-500 p-8 text-center text-white">

            <div class="text-7xl">

              🔥

            </div>

            <h2 class="mt-4 text-3xl font-black">

              Kebakaran

            </h2>

          </div>

          <div class="p-8">

            <p class="text-slate-600">

              Ketahui langkah penyelamatan saat terjadi kebakaran.

            </p>

            <div class="mt-6 flex items-center justify-between">

              <span class="rounded-full bg-yellow-100 px-4 py-2 text-sm font-bold text-yellow-700">

                ⭐⭐ Sedang

              </span>

              <span class="font-bold text-blue-600">

                12 Menit

              </span>

            </div>

            <button disabled class="mt-8 w-full cursor-not-allowed rounded-2xl bg-slate-300 py-4 font-bold text-slate-500">

              🔒 Segera Hadir

            </button>

          </div>

        </div>

      </div>

      {{-- Aksa Tips --}}
      <div class="mt-12 rounded-[35px] bg-white p-8 shadow-xl">

        <div class="flex items-center gap-8">

          <img src="{{ Vite::asset('resources/images/mascot/aksa.png') }}" class="h-40">

          <div>

            <h2 class="text-3xl font-black">

              💡 Tips dari Aksa

            </h2>

            <p class="mt-4 text-lg leading-8 text-slate-600">

              "Belajar dulu ya sebelum bermain. Semakin banyak materi yang kamu pelajari,
              semakin mudah menyelesaikan misi nanti!"

            </p>

          </div>

        </div>

      </div>

    </div>

  </section>

@endsection
