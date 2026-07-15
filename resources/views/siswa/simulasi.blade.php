@extends('layouts.siswa')

@section('title', 'Petualangan')

@section('content')

  <section x-data="{
      misi: 'gempa',
      mode: null,
      status: 'belum', // belum | proses | siap
      showPanduan: false,
      data: {
          gempa: {
              judul: 'Gempa Bumi',
              icon: '🌍',
              warna: 'from-orange-400 to-red-400',
              teks: 'bg-orange-500 hover:bg-orange-600',
              deskripsi: 'Belajar cara berlindung dan menyelamatkan diri ketika terjadi gempa bumi melalui simulasi interaktif.',
              kata: 'Ayo berlindung di bawah meja!',
              tokoh: 'aksa',
          },
          banjir: {
              judul: 'Banjir',
              icon: '🌊',
              warna: 'from-blue-500 to-cyan-500',
              teks: 'bg-blue-600 hover:bg-blue-700',
              deskripsi: 'Pelajari cara evakuasi yang aman dan tindakan yang harus dilakukan saat banjir datang.',
              kata: 'Ayo cari tempat yang lebih tinggi!',
              tokoh: 'reka',
          }
      },
      pilihMisi(m) {
          this.misi = m;
          this.mode = null;
          this.status = 'belum';
      },
      pilihMode(m) {
          this.mode = m;
          this.status = m === 'digital' ? 'siap' : 'belum';
      },
      hubungkan() {
          this.status = 'proses';
          setTimeout(() => { this.status = 'siap'; }, 1500);
      },
      bisaMulai() {
          return this.mode !== null && this.status === 'siap';
      }
  }" class="relative min-h-screen overflow-hidden bg-gradient-to-br from-sky-100 via-white to-cyan-100">

    {{-- Background --}}
    <div class="absolute inset-0">
      <div class="absolute -left-32 top-10 h-96 w-96 rounded-full bg-blue-200/40 blur-3xl"></div>
      <div class="absolute right-0 bottom-0 h-[450px] w-[450px] rounded-full bg-cyan-200/40 blur-3xl"></div>
      <div class="absolute left-1/2 top-1/2 h-[500px] w-[500px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-sky-100/40 blur-3xl"></div>
    </div>

    <div class="relative z-10 mx-auto flex min-h-screen max-w-7xl flex-col px-6 py-6">

      {{-- Header --}}
      <div class="flex items-center justify-between">

        <div class="flex items-center gap-4">
          <img src="{{ Vite::asset('resources/images/logo/logo.png') }}" class="h-14">
          <h1 class="text-3xl font-black tracking-tight text-slate-800">
            🎮 Petualangan Siaga
          </h1>
        </div>

        <a href="/siswa/home" class="rounded-xl bg-white px-5 py-2.5 font-semibold text-slate-500 shadow transition hover:text-blue-600">
          ← Kembali
        </a>

      </div>

      {{-- Body: split kiri-kanan --}}
      <div class="mt-6 grid flex-1 grid-cols-12 gap-6">

        {{-- KIRI: List Misi --}}
        <div class="col-span-4 flex flex-col gap-5">

          <p class="px-2 text-sm font-bold uppercase tracking-wide text-slate-400">
            Pilih Misi
          </p>

          <template x-for="(item, key) in data" :key="key">

            <div @click="pilihMisi(key)"
              :class="misi === key ?
                  'ring-4 ring-blue-400 scale-[1.02]' :
                  'ring-0 hover:-translate-y-2'"
              class="cursor-pointer overflow-hidden rounded-[28px] bg-white shadow-xl shadow-sky-100/70 transition-all duration-300 hover:shadow-2xl">

              <div :class="'bg-gradient-to-r p-6 text-center text-white ' + item.warna">

                <div class="text-6xl" x-text="item.icon"></div>

                <h2 class="mt-2 text-xl font-black" x-text="item.judul"></h2>

              </div>

              <div class="flex items-center justify-between px-6 py-3">

                <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                  ⭐ Mudah
                </span>

                <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-bold text-yellow-700">
                  🎯 100 XP
                </span>

              </div>

            </div>

          </template>

          {{-- Maskot kecil di bawah list --}}
          <div class="mt-auto flex justify-center gap-4 pt-4">
            <img src="{{ Vite::asset('resources/images/mascot/aksa.png') }}" class="h-40 transition duration-300 hover:-translate-y-2 hover:rotate-2">
            <img src="{{ Vite::asset('resources/images/mascot/reka.png') }}" class="h-40 transition duration-300 hover:-translate-y-2 hover:-rotate-2">
          </div>

        </div>

        {{-- KANAN: Detail + Mode + Status --}}
        <div class="col-span-8 flex flex-col overflow-y-auto rounded-[32px] border border-white/70 bg-white/90 p-8 shadow-xl backdrop-blur-md">

          {{-- Judul Misi --}}
          <div class="flex items-center gap-4">

            <div :class="'flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-r text-3xl text-white ' + data[misi].warna"
              x-text="data[misi].icon">
            </div>

            <div>
              <h2 class="text-3xl font-black text-slate-800" x-text="data[misi].judul"></h2>
              <p class="text-slate-500" x-text="data[misi].deskripsi"></p>
            </div>

          </div>

          {{-- Ucapan Maskot --}}
          <div class="mt-5 flex items-center gap-4 rounded-2xl bg-sky-50 p-4">

            <img
              :src="data[misi].tokoh === 'aksa' ?
                  '{{ Vite::asset('resources/images/mascot/aksa.png') }}' :
                  '{{ Vite::asset('resources/images/mascot/reka.png') }}'"
              class="h-14">

            <p class="font-semibold leading-relaxed text-slate-700">

              <span class="font-black text-blue-600" x-text="data[misi].tokoh === 'aksa' ? 'Aska' : 'Reka'">
              </span>

              berkata,

              <span class="italic text-slate-600" x-text="data[misi].kata">
              </span>

            </p>

          </div>

          {{-- Pilih Mode --}}
          <div class="mt-8">

            <p class="mb-4 text-sm font-bold uppercase tracking-wide text-slate-400">
              Pilih Cara Bermain
            </p>

            <div class="grid gap-5 lg:grid-cols-2">

              {{-- Digital --}}
              <div @click="pilihMode('digital')" :class="mode === 'digital' ? 'border-blue-500 bg-blue-50' : 'border-slate-200 hover:border-blue-300'"
                class="cursor-pointer rounded-3xl border-2 p-6 transition-all duration-300">

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-100 text-3xl">
                  💻
                </div>

                <h3 class="mt-4 text-lg font-black">Mode Digital</h3>

                <p class="mt-1 text-sm text-slate-500">
                  Main langsung di layar, tanpa alat.
                </p>

                <span class="mt-3 inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-bold text-blue-700">
                  Tanpa Alat
                </span>

              </div>

              {{-- RESQ-KIT --}}
              <div @click="pilihMode('arduino')"
                :class="mode === 'arduino' ? 'border-green-500 bg-green-50' : 'border-slate-200 hover:border-green-300'"
                class="cursor-pointer rounded-3xl border-2 p-6 transition-all duration-300">

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-green-100 text-3xl">
                  🧩
                </div>

                <h3 class="mt-4 text-lg font-black">Mode RESQ-KIT</h3>

                <p class="mt-1 text-sm text-slate-500">
                  Main pakai diorama RESQ-KIT.
                </p>

                <span class="mt-3 inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                  Dengan Alat
                </span>

              </div>

            </div>

          </div>

          {{-- Status khusus RESQ-KIT --}}
          <div x-show="mode === 'arduino'" x-transition class="mt-6">

            <div class="flex items-center justify-between rounded-2xl bg-slate-50 p-5">

              <div class="flex items-center gap-3">

                <span x-text="status === 'belum' ? '❌' : (status === 'proses' ? '⏳' : '✅')" class="text-xl"></span>

                <span class="font-bold"
                  :class="{
                      'text-red-500': status === 'belum',
                      'text-yellow-600': status === 'proses',
                      'text-green-600': status === 'siap'
                  }"
                  x-text="status === 'belum' ? 'Belum Terhubung' : (status === 'proses' ? 'Menghubungkan...' : 'RESQ-KIT Siap')"></span>

              </div>

              <div class="flex gap-3">

                <button type="button" @click="showPanduan = true"
                  class="cursor-pointer rounded-xl bg-slate-200 px-4 py-2 text-sm font-bold text-slate-700 shadow transition hover:bg-slate-300">
                  📖 Panduan
                </button>

                <button x-show="status !== 'siap'" @click="hubungkan()"
                  class="rounded-xl bg-green-600 px-4 py-2 text-sm font-bold text-white transition hover:bg-green-700">
                  🔌 Hubungkan
                </button>

              </div>

            </div>

          </div>

          {{-- Tombol Mulai --}}
          <form action="{{ route('siswa.mulai') }}" method="POST" class="mt-8">
            @csrf

            <input type="hidden" name="misi" :value="misi">
            <input type="hidden" name="mode" :value="mode">

            <button type="submit" :disabled="!bisaMulai()"
              :class="bisaMulai() ?
                  data[misi].teks + ' cursor-pointer' :
                  'bg-slate-300 cursor-not-allowed'"
              class="w-full rounded-3xl py-5 text-lg font-black text-white shadow-xl transition-all duration-300 hover:scale-[1.02] active:scale-[.98]">

              <span x-show="!bisaMulai()">
                Pilih cara bermain dulu ya!
              </span>

              <span x-show="bisaMulai()">
                🚀 Mulai Misi
              </span>

            </button>
          </form>

        </div>

      </div>

      {{-- Modal Panduan Arduino (versi anak-anak) --}}
      <div x-show="showPanduan" x-cloak x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 p-4"
        @click.self="showPanduan = false">

        <div x-show="showPanduan" x-transition class="max-h-[88vh] w-full max-w-2xl overflow-y-auto rounded-[32px] bg-white shadow-2xl">

          {{-- Header --}}
          <div class="relative overflow-hidden rounded-t-[32px] bg-gradient-to-br from-blue-500 to-cyan-500 px-8 py-7 text-center text-white">

            <button type="button" @click="showPanduan = false"
              class="cursor-pointer absolute right-4 top-4 flex h-9 w-9 items-center justify-center rounded-full bg-white text-blue-600 shadow-lg transition hover:bg-blue-50">
              ✕
            </button>

            <div class="flex justify-center gap-1">
              <img src="{{ Vite::asset('resources/images/mascot/aksa.png') }}" class="h-16">
              <img src="{{ Vite::asset('resources/images/mascot/reka.png') }}" class="h-16">
            </div>

            <h2 class="mt-2 text-2xl font-black">Yuk, Nyalain RESQ-KIT! 🚀</h2>
            <p class="mt-1 text-sm text-white/90">Ikutin langkah gampang ini bareng Aksa &amp; Reka ya!</p>

          </div>

          {{-- Body --}}
          <div class="flex flex-col gap-4 px-8 py-7">

            {{-- Step 1 --}}
            <div class="flex gap-4 rounded-2xl border-2 border-sky-50 bg-white p-4 shadow">
              <div
                class="flex h-12 w-12 flex-none items-center justify-center rounded-full bg-gradient-to-br from-blue-400 to-cyan-400 text-2xl shadow">
                🧰
              </div>
              <div>
                <h3 class="mb-1 font-black text-slate-800">1. Siapin dulu semuanya</h3>
                <p class="text-sm text-slate-500">Sebelum mulai, cek dulu barang-barang ini sudah ada semua:</p>
                <ul class="mt-1 list-disc pl-5 text-sm text-slate-500">
                  <li>Diorama RESQ-KIT (yang ada tombol-tombolnya)</li>
                  <li>Kabel USB buat nyambungin ke laptop</li>
                  <li>Laptop yang sudah kebuka halaman RESQ-KIT</li>
                </ul>
              </div>
            </div>

            {{-- Step 2 --}}
            <div class="flex gap-4 rounded-2xl border-2 border-sky-50 bg-white p-4 shadow">
              <div
                class="flex h-12 w-12 flex-none items-center justify-center rounded-full bg-gradient-to-br from-blue-400 to-cyan-400 text-2xl shadow">
                🔌
              </div>
              <div>
                <h3 class="mb-1 font-black text-slate-800">2. Colokin kabelnya</h3>
                <p class="text-sm text-slate-500">Colok kabel USB dari diorama ke laptop. Kalau lampu kecilnya nyala, artinya diorama udah bangun dan
                  siap main!</p>

                <div class="mt-2 flex items-center gap-3 rounded-xl border-2 border-dashed border-yellow-300 bg-yellow-50 px-3 py-2">
                  <img src="{{ Vite::asset('resources/images/mascot/aksa.png') }}" class="h-9">
                  <p class="text-xs font-bold text-yellow-700">Psst! Tutup dulu program lain yang lagi pakai USB ya, biar gak rebutan.</p>
                </div>
              </div>
            </div>

            {{-- Step 3 --}}
            <div class="flex gap-4 rounded-2xl border-2 border-sky-50 bg-white p-4 shadow">
              <div
                class="flex h-12 w-12 flex-none items-center justify-center rounded-full bg-gradient-to-br from-blue-400 to-cyan-400 text-2xl shadow">
                🤝
              </div>
              <div>
                <h3 class="mb-1 font-black text-slate-800">3. Kenalan sama laptop</h3>
                <p class="text-sm text-slate-500">Pas klik tombol "Hubungkan", nanti muncul jendela kecil buat pilih diorama kamu. Klik namanya, terus
                  tekan <b>Hubungkan</b>.</p>
              </div>
            </div>

            {{-- Step 4 --}}
            <div class="flex gap-4 rounded-2xl border-2 border-sky-50 bg-white p-4 shadow">
              <div
                class="flex h-12 w-12 flex-none items-center justify-center rounded-full bg-gradient-to-br from-blue-400 to-cyan-400 text-2xl shadow">
                🎯
              </div>
              <div>
                <h3 class="mb-1 font-black text-slate-800">4. Pilih misi & mulai!</h3>
                <p class="text-sm text-slate-500">Pilih mau misi Gempa atau Banjir, pilih "Mode RESQ-KIT", terus tekan tombol <b>Mulai Misi!</b> Peta
                  petualangan bakal muncul di layar.</p>
              </div>
            </div>

            {{-- Step 5 --}}
            <div class="flex gap-4 rounded-2xl border-2 border-sky-50 bg-white p-4 shadow">
              <div
                class="flex h-12 w-12 flex-none items-center justify-center rounded-full bg-gradient-to-br from-blue-400 to-cyan-400 text-2xl shadow">
                🕹️
              </div>
              <div>
                <h3 class="mb-1 font-black text-slate-800">5. Main pakai diorama</h3>
                <p class="text-sm text-slate-500">Sekarang tinggal tekan tombol di diorama sesuai tempat yang mau kamu tuju. Layar bakal otomatis
                  pindah sendiri, gak perlu klik apa-apa lagi!</p>

                <div class="mt-2 flex items-center gap-3 rounded-xl border-2 border-dashed border-yellow-300 bg-yellow-50 px-3 py-2">
                  <img src="{{ Vite::asset('resources/images/mascot/reka.png') }}" class="h-9">
                  <p class="text-xs font-bold text-yellow-700">Tekan satu kali aja terus tunggu sebentar sebelum tekan tombol lain ya, biar gak keskip!
                  </p>
                </div>
              </div>
            </div>

            {{-- Step 6 --}}
            <div class="flex gap-4 rounded-2xl border-2 border-sky-50 bg-white p-4 shadow">
              <div
                class="flex h-12 w-12 flex-none items-center justify-center rounded-full bg-gradient-to-br from-blue-400 to-cyan-400 text-2xl shadow">
                🆘
              </div>
              <div>
                <h3 class="mb-1 font-black text-slate-800">6. Kalau ada masalah</h3>
                <ul class="list-disc pl-5 text-sm text-slate-500">
                  <li><b>Layar gak gerak?</b> Cek dulu diorama masih nyambung apa nggak</li>
                  <li><b>Diorama gak ketemu?</b> Cabut-colok lagi kabelnya, terus refresh halamannya</li>
                  <li><b>Mau ulang dari awal?</b> Tinggal klik "↺ Ulangi Simulasi"</li>
                </ul>
              </div>
            </div>

          </div>

          {{-- Footer --}}
          <div class="px-8 pb-7 text-center">
            <button type="button" @click="showPanduan = false"
              class="cursor-pointer rounded-full bg-emerald-600 px-8 py-3 text-sm font-black text-white shadow-lg transition hover:scale-[1.02] hover:bg-emerald-700 active:scale-[.98]">
              Siap, Ayo Main! 🎉
            </button>
          </div>

        </div>
      </div>

    </div>

  </section>

@endsection
