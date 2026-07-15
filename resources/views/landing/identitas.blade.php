@extends('layouts.app')

@section('title', 'Mulai Petualangan')

@section('content')

  <section class="relative flex min-h-screen items-center justify-center overflow-hidden bg-gradient-to-br from-sky-50 via-white to-cyan-50">

    <div class="absolute inset-0">
      <div class="absolute -left-32 top-10 h-80 w-80 rounded-full bg-blue-200/40 blur-3xl"></div>
      <div class="absolute bottom-0 right-0 h-96 w-96 rounded-full bg-cyan-200/40 blur-3xl"></div>
    </div>

    <div class="relative z-10 w-full max-w-5xl rounded-[40px] bg-white/80 p-10 shadow-2xl backdrop-blur-xl">

      <div x-data="{ gender: 'L' }" class="grid items-center gap-10 lg:grid-cols-2">

        {{-- Maskot --}}
        <div class="flex flex-col items-center">

          <img
            :src="gender === 'L'
                ?
                '{{ Vite::asset('resources/images/mascot/aksa.png') }}' :
                '{{ Vite::asset('resources/images/mascot/reka.png') }}'"
            :key="gender" class="h-72 transition-all duration-300">

          <div class="mt-6 rounded-2xl bg-blue-100 px-6 py-4 text-center">

            <p class="font-bold text-blue-700">
              👋 Halo Sahabat!
            </p>

            <p class="mt-2 text-slate-600">
              Sebelum mulai, kenalan dulu yuk!
            </p>

          </div>

        </div>

        {{-- Form --}}
        <div>

          <h1 class="text-4xl font-black text-slate-800">
            Siapa Nama Kamu?
          </h1>

          <p class="mt-3 text-slate-500">
            Isi dulu ya supaya hasil belajarmu bisa disimpan.
          </p>

          <form action="{{ url('/identitas') }}" method="POST" class="mt-6 space-y-6">

            @csrf

            <div>

              <select x-model="gender" name="jenis_kelamin"
                class="w-full rounded-2xl border-2 border-slate-200 px-5 py-4 text-lg outline-none transition focus:border-blue-500">

                <option value="L">
                  👦 Laki-laki
                </option>

                <option value="P">
                  👧 Perempuan
                </option>

              </select>

            </div>

            <div>

              <label class="mb-2 block font-semibold">
                Nama
              </label>

              <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh : Budi"
                class="w-full rounded-2xl border-2 border-slate-200 px-5 py-4 text-lg outline-none transition focus:border-blue-500" required>

              @error('nama')
                <p class="mt-2 text-sm text-red-500">
                  {{ $message }}
                </p>
              @enderror

            </div>

            <div>

              <label class="mb-2 block font-semibold">
                Kelas
              </label>

              <select name="kelas_id"
                class="w-full rounded-2xl border-2 border-slate-200 px-5 py-4 text-lg outline-none transition focus:border-blue-500" required>

                <option value="" disabled selected>
                  Pilih Kelas
                </option>

                @foreach ($kelas as $item)
                  <option value="{{ $item->id }}" {{ old('kelas_id') == $item->id ? 'selected' : '' }}>

                    {{ $item->nama_kelas }}

                  </option>
                @endforeach

              </select>

              @error('kelas_id')
                <p class="mt-2 text-sm text-red-500">
                  {{ $message }}
                </p>
              @enderror

            </div>

            <button type="submit"
              class="mt-4 flex w-full items-center justify-center rounded-2xl bg-blue-600 py-4 text-lg font-bold text-white shadow-lg shadow-blue-300/40 transition duration-300 hover:-translate-y-1 hover:bg-blue-700 hover:shadow-xl">

              🚀 Mulai Belajar

            </button>

          </form>

        </div>

      </div>

    </div>

  </section>

@endsection
