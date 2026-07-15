@extends('layouts.siswa')

@section('title', 'Materi Banjir')

@section('content')

  <section class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-cyan-50">

    <div class="mx-auto max-w-5xl px-6 py-10">

      {{-- Header --}}
      <div class="flex items-center justify-between">

        <div>

          <span class="rounded-full bg-blue-100 px-4 py-2 font-bold text-blue-600">

            📖 Materi 2

          </span>

          <h1 class="mt-5 text-5xl font-black">

            🌊 Banjir

          </h1>

          <p class="mt-3 text-lg text-slate-500">

            Belajar mengenal banjir bersama Aksa dan Reka.

          </p>

        </div>

        <img src="{{ Vite::asset('resources/images/mascot/aksa.png') }}" class="h-52">

      </div>

      {{-- Progress --}}
      <div class="mt-8">

        <div class="mb-2 flex justify-between text-sm font-semibold">

          <span>Progress Materi</span>

          <span>2 / 5</span>

        </div>

        <div class="h-3 overflow-hidden rounded-full bg-slate-200">

          <div class="h-full w-2/5 rounded-full bg-blue-500"></div>

        </div>

      </div>

      {{-- Card: Apa Itu Banjir --}}
      <div class="mt-10 rounded-[35px] bg-white p-10 shadow-xl">

        <div class="text-center">

          <div class="text-8xl">

            🌊

          </div>

          <h2 class="mt-6 text-4xl font-black">

            Apa Itu Banjir?

          </h2>

        </div>

        <p class="mt-8 text-center text-xl leading-10 text-slate-600">

          Banjir adalah kondisi ketika air meluap dan menggenangi daratan karena
          hujan deras, sungai meluap, atau saluran air yang tersumbat. Banjir
          bisa terjadi tiba-tiba, jadi kita harus tahu apa yang harus dilakukan.

        </p>

        <div class="mt-10 rounded-3xl bg-blue-50 p-6">

          <div class="flex items-start gap-5">

            <img src="{{ Vite::asset('resources/images/mascot/aksa.png') }}" class="h-24">

            <div>

              <h3 class="text-xl font-bold text-blue-600">

                Kata Aksa

              </h3>

              <p class="mt-2 leading-8 text-slate-600">

                "Banjir bisa datang kapan saja saat musim hujan. Yuk kita
                pelajari cara mengenali dan menghadapinya bersama-sama!"

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

              Sampah yang menumpuk di selokan adalah salah satu penyebab utama
              banjir di kota-kota besar Indonesia karena air hujan tidak bisa
              mengalir dengan lancar.

            </p>

          </div>

        </div>

      </div>

      {{-- Tanda-Tanda Banjir --}}
      <div class="mt-10 rounded-[35px] bg-white p-10 shadow-xl">

        <h2 class="text-center text-4xl font-black">

          ⚠️ Tanda-Tanda Banjir

        </h2>

        <p class="mt-3 text-center text-slate-500">

          Ayo kenali tanda-tandanya.

        </p>

        <div class="mt-10 grid gap-6 md:grid-cols-2">

          <div class="rounded-3xl bg-blue-50 p-6">

            <div class="text-5xl">🌧️</div>

            <h3 class="mt-4 text-xl font-bold">Hujan Deras Lama</h3>

            <p class="mt-2 text-slate-600">
              Hujan turun terus-menerus tanpa henti.
            </p>

          </div>

          <div class="rounded-3xl bg-cyan-50 p-6">

            <div class="text-5xl">🏞️</div>

            <h3 class="mt-4 text-xl font-bold">Air Sungai Naik</h3>

            <p class="mt-2 text-slate-600">
              Permukaan air sungai terlihat semakin tinggi.
            </p>

          </div>

          <div class="rounded-3xl bg-teal-50 p-6">

            <div class="text-5xl">🚰</div>

            <h3 class="mt-4 text-xl font-bold">Selokan Meluap</h3>

            <p class="mt-2 text-slate-600">
              Air mulai keluar dari selokan ke jalan.
            </p>

          </div>

          <div class="rounded-3xl bg-indigo-50 p-6">

            <div class="text-5xl">🌫️</div>

            <h3 class="mt-4 text-xl font-bold">Air Keruh</h3>

            <p class="mt-2 text-slate-600">
              Warna air berubah menjadi lebih keruh dari biasanya.
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

            <div class="text-5xl">📻</div>

            <p class="text-lg font-medium">
              Dengarkan informasi dari radio atau petugas setempat.
            </p>

          </div>

          <div class="flex items-center gap-5 rounded-3xl bg-green-50 p-6">

            <div class="text-5xl">🔌</div>

            <p class="text-lg font-medium">
              Matikan listrik dan gas sebelum meninggalkan rumah.
            </p>

          </div>

          <div class="flex items-center gap-5 rounded-3xl bg-green-50 p-6">

            <div class="text-5xl">🏔️</div>

            <p class="text-lg font-medium">
              Segera pindah ke tempat yang lebih tinggi.
            </p>

          </div>

          <div class="flex items-center gap-5 rounded-3xl bg-green-50 p-6">

            <div class="text-5xl">👨‍👩‍👧</div>

            <p class="text-lg font-medium">
              Ikuti arahan orang tua atau petugas evakuasi.
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

              "Simpan nomor telepon penting keluarga dan tetangga di tempat yang
              mudah diingat, supaya kamu bisa cepat minta bantuan saat banjir."

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

            <div class="text-6xl">🏊</div>

            <h3 class="mt-5 text-xl font-bold">
              Jangan Bermain di Air Banjir
            </h3>

          </div>

          <div class="rounded-3xl bg-red-50 p-6 text-center">

            <div class="text-6xl">🔌</div>

            <h3 class="mt-5 text-xl font-bold">
              Jangan Sentuh Kabel Listrik
            </h3>

          </div>

          <div class="rounded-3xl bg-red-50 p-6 text-center">

            <div class="text-6xl">🚗</div>

            <h3 class="mt-5 text-xl font-bold">
              Jangan Nekat Menerobos Banjir
            </h3>

          </div>

          <div class="rounded-3xl bg-red-50 p-6 text-center">

            <div class="text-6xl">🕳️</div>

            <h3 class="mt-5 text-xl font-bold">
              Jangan Dekati Selokan Terbuka
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

            <div class="text-6xl">📄</div>

            <p class="mt-4 font-bold">
              Dokumen Penting
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

              "Menurut kamu, apa yang bisa kita lakukan supaya lingkungan
              rumah tidak mudah kebanjiran? Coba diskusikan dengan temanmu ya!"

            </p>

          </div>

        </div>

      </div>

      {{-- Penutup: Pujian Reka --}}
      <div class="mt-10 rounded-[35px] bg-gradient-to-r from-blue-500 to-cyan-500 p-10 text-white shadow-xl">

        <div class="flex items-center gap-8">

          <img src="{{ Vite::asset('resources/images/mascot/reka.png') }}" class="h-40">

          <div>

            <h2 class="text-3xl font-black">

              🎉 Kerja Bagus!

            </h2>

            <p class="mt-4 text-lg leading-8">

              "Kamu sudah mempelajari dasar-dasar menghadapi banjir dengan
              baik. Sekarang saatnya mencoba simulasi bersama RESQ-KIT!"

            </p>

            <div class="mt-8 flex gap-4">

              <a href="/siswa/materi" class="rounded-2xl bg-white px-8 py-4 font-bold text-blue-600">

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

        <a href="/siswa/materi/gempa" class="rounded-2xl bg-blue-500 px-8 py-4 font-bold text-white hover:bg-blue-600">

          Selanjutnya →

        </a>

      </div>

    </div>

  </section>

@endsection
