@extends('layouts.siswa')

@section('title', 'Materi Gempa')

@section('content')

  <section class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-red-50">

    <div class="mx-auto max-w-5xl px-6 py-10">

      {{-- Header --}}
      <div class="flex items-center justify-between">

        <div>

          <span class="rounded-full bg-orange-100 px-4 py-2 font-bold text-orange-600">

            📖 Materi 1

          </span>

          <h1 class="mt-5 text-5xl font-black">

            🌍 Gempa Bumi

          </h1>

          <p class="mt-3 text-lg text-slate-500">

            Belajar mengenal gempa bumi bersama Aksa dan Reka.

          </p>

        </div>

        <img src="{{ Vite::asset('resources/images/mascot/aksa.png') }}" class="h-52">

      </div>

      {{-- Progress --}}
      <div class="mt-8">

        <div class="mb-2 flex justify-between text-sm font-semibold">

          <span>Progress Materi</span>

          <span>1 / 5</span>

        </div>

        <div class="h-3 overflow-hidden rounded-full bg-slate-200">

          <div class="h-full w-1/5 rounded-full bg-orange-500"></div>

        </div>

      </div>

      {{-- Card: Apa Itu Gempa Bumi --}}
      <div class="mt-10 rounded-[35px] bg-white p-10 shadow-xl">

        <div class="text-center">

          <div class="text-8xl">

            🌍

          </div>

          <h2 class="mt-6 text-4xl font-black">

            Apa Itu Gempa Bumi?

          </h2>

        </div>

        <p class="mt-8 text-center text-xl leading-10 text-slate-600">

          Gempa bumi adalah getaran yang terjadi karena pergeseran lempeng bumi
          atau aktivitas gunung api. Gempa dapat terjadi kapan saja sehingga kita
          harus selalu siap menghadapinya.

        </p>

        <div class="mt-10 rounded-3xl bg-orange-50 p-6">

          <div class="flex items-start gap-5">

            <img src="{{ Vite::asset('resources/images/mascot/aksa.png') }}" class="h-24">

            <div>

              <h3 class="text-xl font-bold text-orange-600">

                Kata Aksa

              </h3>

              <p class="mt-2 leading-8 text-slate-600">

                "Halo teman-teman! Yuk belajar bersama supaya kita tahu apa yang
                harus dilakukan saat terjadi gempa bumi."

              </p>

            </div>

          </div>

        </div>

      </div>

      {{-- Tahukah Kamu (Aksa - fakta) --}}
      <div class="mt-10 rounded-[35px] bg-gradient-to-r from-blue-500 to-cyan-500 p-10 text-white shadow-xl">

        <div class="flex items-center gap-8">

          <img src="{{ Vite::asset('resources/images/mascot/aksa.png') }}" class="h-40">

          <div>

            <h2 class="text-4xl font-black">

              🤔 Tahukah Kamu?

            </h2>

            <p class="mt-5 text-lg leading-9">

              Indonesia berada di pertemuan tiga lempeng tektonik besar sehingga
              menjadi salah satu negara yang paling sering mengalami gempa bumi.

            </p>

          </div>

        </div>

      </div>

      {{-- Tanda-Tanda Gempa --}}
      <div class="mt-10 rounded-[35px] bg-white p-10 shadow-xl">

        <h2 class="text-center text-4xl font-black">

          ⚠️ Tanda-Tanda Gempa

        </h2>

        <p class="mt-3 text-center text-slate-500">

          Ayo kenali tanda-tandanya.

        </p>

        <div class="mt-10 grid gap-6 md:grid-cols-2">

          <div class="rounded-3xl bg-orange-50 p-6">

            <div class="text-5xl">🏠</div>

            <h3 class="mt-4 text-xl font-bold">Rumah Bergetar</h3>

            <p class="mt-2 text-slate-600">
              Dinding dan lantai mulai bergoyang.
            </p>

          </div>

          <div class="rounded-3xl bg-blue-50 p-6">

            <div class="text-5xl">💡</div>

            <h3 class="mt-4 text-xl font-bold">Lampu Bergoyang</h3>

            <p class="mt-2 text-slate-600">
              Lampu gantung bergerak sendiri.
            </p>

          </div>

          <div class="rounded-3xl bg-green-50 p-6">

            <div class="text-5xl">🪑</div>

            <h3 class="mt-4 text-xl font-bold">Barang Bergeser</h3>

            <p class="mt-2 text-slate-600">
              Meja atau kursi mulai berpindah.
            </p>

          </div>

          <div class="rounded-3xl bg-purple-50 p-6">

            <div class="text-5xl">🌎</div>

            <h3 class="mt-4 text-xl font-bold">Tanah Bergetar</h3>

            <p class="mt-2 text-slate-600">
              Getaran terasa dari bawah kaki.
            </p>

          </div>

        </div>

      </div>

      {{-- Yang Harus Dilakukan --}}
      <div class="mt-10 rounded-[35px] bg-white p-10 shadow-xl">

        <h2 class="text-center text-4xl font-black text-green-600">

          ✅ Yang Harus Dilakukan

        </h2>

        <div class="mt-10 space-y-5">

          <div class="flex items-center gap-5 rounded-3xl bg-green-50 p-6">

            <div class="text-5xl">🧘</div>

            <p class="text-lg font-medium">
              Tetap tenang dan jangan panik.
            </p>

          </div>

          <div class="flex items-center gap-5 rounded-3xl bg-green-50 p-6">

            <div class="text-5xl">🪑</div>

            <p class="text-lg font-medium">
              Berlindung di bawah meja yang kuat.
            </p>

          </div>

          <div class="flex items-center gap-5 rounded-3xl bg-green-50 p-6">

            <div class="text-5xl">🙆</div>

            <p class="text-lg font-medium">
              Lindungi kepala menggunakan tas atau tangan.
            </p>

          </div>

          <div class="flex items-center gap-5 rounded-3xl bg-green-50 p-6">

            <div class="text-5xl">🚶</div>

            <p class="text-lg font-medium">
              Keluar ke tempat terbuka setelah gempa berhenti.
            </p>

          </div>

        </div>

      </div>

      {{-- Tips Reka --}}
      <div class="mt-10 rounded-[35px] bg-gradient-to-r from-pink-500 to-fuchsia-500 p-10 text-white shadow-xl">

        <div class="flex items-center gap-8">

          <img src="{{ Vite::asset('resources/images/mascot/reka.png') }}" class="h-40">

          <div>

            <h2 class="text-4xl font-black">

              💡 Tips dari Reka

            </h2>

            <p class="mt-5 text-lg leading-9">

              "Selalu ingat posisi meja atau benda kuat di dekatmu. Kalau sudah
              hafal, kamu bisa berlindung lebih cepat saat gempa terjadi!"

            </p>

          </div>

        </div>

      </div>

      {{-- Yang Tidak Boleh Dilakukan --}}
      <div class="mt-10 rounded-[35px] bg-white p-10 shadow-xl">

        <h2 class="text-center text-4xl font-black text-red-500">

          ❌ Yang Tidak Boleh Dilakukan

        </h2>

        <div class="mt-10 grid gap-6 md:grid-cols-2">

          <div class="rounded-3xl bg-red-50 p-6 text-center">

            <div class="text-6xl">😱</div>

            <h3 class="mt-5 text-xl font-bold">
              Jangan Panik
            </h3>

          </div>

          <div class="rounded-3xl bg-red-50 p-6 text-center">

            <div class="text-6xl">🏃</div>

            <h3 class="mt-5 text-xl font-bold">
              Jangan Berlari Berdesakan
            </h3>

          </div>

          <div class="rounded-3xl bg-red-50 p-6 text-center">

            <div class="text-6xl">🪟</div>

            <h3 class="mt-5 text-xl font-bold">
              Jangan Dekat Kaca
            </h3>

          </div>

          <div class="rounded-3xl bg-red-50 p-6 text-center">

            <div class="text-6xl">🛗</div>

            <h3 class="mt-5 text-xl font-bold">
              Jangan Menggunakan Lift
            </h3>

          </div>

        </div>

      </div>

      {{-- Tas Siaga --}}
      <div class="mt-10 rounded-[35px] bg-white p-10 shadow-xl">

        <h2 class="text-center text-4xl font-black">

          🎒 Isi Tas Siaga

        </h2>

        <div class="mt-10 grid grid-cols-2 gap-6 md:grid-cols-4">

          <div class="rounded-3xl bg-slate-100 p-6 text-center">

            <div class="text-6xl">💧</div>

            <p class="mt-4 font-bold">
              Air Minum
            </p>

          </div>

          <div class="rounded-3xl bg-slate-100 p-6 text-center">

            <div class="text-6xl">🔦</div>

            <p class="mt-4 font-bold">
              Senter
            </p>

          </div>

          <div class="rounded-3xl bg-slate-100 p-6 text-center">

            <div class="text-6xl">🩹</div>

            <p class="mt-4 font-bold">
              Kotak P3K
            </p>

          </div>

          <div class="rounded-3xl bg-slate-100 p-6 text-center">

            <div class="text-6xl">🥫</div>

            <p class="mt-4 font-bold">
              Makanan
            </p>

          </div>

        </div>

      </div>

      {{-- Pertanyaan Reka --}}
      <div class="mt-10 rounded-[35px] bg-gradient-to-r from-pink-500 to-fuchsia-500 p-10 text-white shadow-xl">

        <div class="flex items-center gap-8">

          <img src="{{ Vite::asset('resources/images/mascot/reka.png') }}" class="h-40">

          <div>

            <h2 class="text-3xl font-black">

              ❓ Coba Jawab Yuk!

            </h2>

            <p class="mt-4 text-lg leading-8">

              "Menurut kamu, kenapa Indonesia sering mengalami gempa bumi?
              Coba diskusikan dengan teman atau gurumu ya!"

            </p>

          </div>

        </div>

      </div>

      {{-- Penutup: Pujian Reka --}}
      <div class="mt-10 rounded-[35px] bg-gradient-to-r from-orange-500 to-red-500 p-10 text-white shadow-xl">

        <div class="flex items-center gap-8">

          <img src="{{ Vite::asset('resources/images/mascot/aksa.png') }}" class="h-40">

          <div>

            <h2 class="text-3xl font-black">

              🎉 Kerja Bagus!

            </h2>

            <p class="mt-4 text-lg leading-8">

              "Kamu sudah mempelajari dasar-dasar menghadapi gempa bumi dengan
              baik. Sekarang saatnya mencoba simulasi bersama RESQ-KIT!"

            </p>

            <div class="mt-8 flex gap-4">

              <a href="/siswa/materi" class="rounded-2xl bg-white px-8 py-4 font-bold text-orange-600">

                ← Materi Lain

              </a>

              <a href="/siswa/simulasi" class="rounded-2xl border-2 border-white px-8 py-4 font-bold">

                🎮 Ke Simulasi

              </a>

            </div>

          </div>

        </div>

      </div>

      {{-- Selanjutnya --}}
      <div class="mt-8 flex justify-between">

        <a href="/siswa/materi" class="rounded-2xl border-2 border-slate-300 px-8 py-4 font-bold">

          ← Daftar Materi

        </a>

        <a href="/siswa/materi/banjir" class="rounded-2xl bg-orange-500 px-8 py-4 font-bold text-white hover:bg-orange-600">

          Selanjutnya →

        </a>

      </div>

    </div>

  </section>

@endsection
