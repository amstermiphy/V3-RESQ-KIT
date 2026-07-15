@extends('layouts.app')
@section('title', 'RESQ-KIT')
@section('content')

  <section class="relative flex min-h-screen items-center justify-center overflow-hidden bg-gradient-to-br from-sky-50 via-white to-cyan-50">

    {{-- Background --}}
    <div class="absolute inset-0">
      {{-- Blur Background --}}
      <div class="absolute -left-40 top-0 h-96 w-96 rounded-full bg-sky-200/40 blur-3xl"></div>
      <div class="absolute right-0 top-20 h-80 w-80 rounded-full bg-cyan-200/40 blur-3xl"></div>
      <div class="absolute bottom-0 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-blue-100 blur-3xl"></div>

      <img src="{{ Vite::asset('resources/images/mascot/awan.png') }}"
        class="absolute -left-16 top-16 w-72 opacity-30 pointer-events-none select-none animate-cloud-left">
      <img src="{{ Vite::asset('resources/images/mascot/awan.png') }}"
        class="absolute -right-20 top-32 w-80 opacity-30 pointer-events-none select-none animate-cloud-right">
      <img src="{{ Vite::asset('resources/images/mascot/awan.png') }}"
        class="absolute bottom-12 right-40 w-56 opacity-20 pointer-events-none select-none animate-cloud-bottom">
    </div>

    <div class="relative z-10 flex max-w-6xl flex-col items-center px-4 text-center">
      {{-- Logo --}}
      <img src="{{ Vite::asset('resources/images/logo/logo.png') }}" alt="RESQ-KIT" class="h-50 w-auto">
      <h1 class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-6xl font-black text-transparent lg:text-7xl">
        RESQ-KIT
      </h1>
      <p class="mt-5 max-w-xl text-2xl font-semibold text-slate-700">
        Media Pembelajaran Interaktif
      </p>
      <p class="mt-2 max-w-2xl text-lg leading-8 text-slate-500">
        Belajar mitigasi bencana dengan simulasi berbasis Arduino,
        permainan interaktif, dan petualangan seru bersama
        <span class="font-semibold text-blue-600">Aska</span>
        &
        <span class="font-semibold text-pink-500">Reka</span>.
      </p>
      {{-- Button --}}
      <div class="mt-10">
        <a href="/identitas"
          class="inline-flex items-center gap-3 rounded-2xl bg-blue-600 px-10 py-5 text-xl font-bold text-white shadow-xl shadow-blue-300/40 transition duration-300 hover:-translate-y-1 hover:scale-105 hover:bg-blue-700">
          🚀
          Mulai Petualangan
        </a>
      </div>
      {{-- Login Guru --}}
      <div class="mt-6">
        <a href="/login" class="group text-base font-semibold text-slate-500 transition hover:text-blue-600">
          Masuk sebagai Guru
          <span class="transition group-hover:ml-2">
            →
          </span>
        </a>
      </div>
    </div>
  </section>
@endsection
