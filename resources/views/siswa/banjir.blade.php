@extends('layouts.siswa')

@section('title', 'Misi Banjir')

@section('content')

  <section x-data="{
      current: 'start',
      hearts: 3,
      xp: 0,
      typed: '',
      typingDone: false,
      typeTimer: null,
      feedback: null,
      walking: false,
      speakerScale: false,
      expression: 'normal',
      shake: false,
      selectedItems: [],
      banner: null,
  
      weather: {
          rain: 10,
          water: 0,
          storm: false,
          flash: false,
      },
  
      {{-- ====== POSISI KARAKTER DI PETA (persen relatif ke gambar peta) ====== --}}
      positions: {
          sekolah: { left: '76%', top: '48%' },
          titik_kumpul: { left: '68%', top: '68%' },
          rumah: { left: '16%', top: '48%' },
          posko_bukit: { left: '8%', top: '15%' },
          sungai: { left: '45%', top: '78%' },
      },
  
      {{-- ====== CHECKPOINT YANG MUNCUL DI SIDEBAR "JEJAK RUTE" ====== --}}
      mapPoints: [
          { key: 'sekolah', emoji: '🏫', label: 'Sekolah' },
          { key: 'titik_kumpul', emoji: '🚩', label: 'Titik Kumpul' },
          { key: 'rumah', emoji: '🏠', label: 'Rumah' },
          { key: 'posko_bukit', emoji: '🏕️', label: 'Posko Bukit' },
      ],
  
      visited: ['sekolah'],
  
      nodes: {
  
          {{-- ============================================================ --}}
          {{-- FASE 1 — DI SEKOLAH: BUILD-UP HUJAN & PANIK                  --}}
          {{-- ============================================================ --}}
  
          start: {
              type: 'narasi',
              location: 'sekolah',
              text: 'Pagi ini seperti biasa, kalian belajar di kelas. Namun sejak semalam, hujan sudah turun cukup deras di luar sana.',
              next: 'hujan_mulai'
          },
  
          hujan_mulai: {
              type: 'event',
              location: 'sekolah',
              banner: { text: '🌧️ Hujan mulai turun semakin deras...', icon: '🌧️', duration: 2200 },
              text: 'Suara hujan semakin keras terdengar memukul atap sekolah. Langit di luar jendela terlihat semakin gelap.',
              next: 'reka_intro'
          },
  
          reka_intro: {
              type: 'dialog',
              tokoh: 'reka',
              location: 'sekolah',
              text: 'Teman-teman, coba lihat ke luar jendela. Sepertinya air sungai di kejauhan mulai naik!',
              next: 'lantai_basah'
          },
  
          lantai_basah: {
              type: 'event',
              location: 'sekolah',
              banner: { text: '💧 Kalian tidak sadar, air mulai merembes masuk ke dalam kelas...', icon: '💧', duration: 2400 },
              text: 'Tanpa disadari, lantai kelas mulai terasa basah. Air perlahan merembes masuk dari celah pintu.',
              next: 'panik_dialog'
          },
  
          panik_dialog: {
              type: 'dialog',
              tokoh: 'reka',
              location: 'sekolah',
              text: 'Eh, lantai kok basah?! Airnya... airnya masuk ke kelas kita!',
              next: 'quiz1'
          },
  
          quiz1: {
              type: 'quiz',
              location: 'sekolah',
              scenario: 'Bu Guru sudah mengumumkan lewat pengeras suara bahwa air sungai mulai naik dan berpotensi meluap ke arah sekolah. Beberapa temanmu mulai panik dan berlarian sendiri-sendiri menuju pintu keluar.',
              ipa: 'Air banjir mengalir dari tempat tinggi ke tempat rendah mengikuti gravitasi. Sekolah yang berada dekat aliran sungai berisiko lebih cepat terendam dibanding area yang posisinya lebih tinggi.',
              pertanyaan: 'Apa yang sebaiknya kamu lakukan saat mendengar pengumuman ini?',
              next: 'cabang1',
              pilihan: [
                  { poin: 25, label: 'Tetap tenang, beri tahu guru apa yang kamu lihat, lalu ikuti arahan evakuasi bersama teman-teman sekelas.', feedback: '⭐ TERBAIK! Tetap tenang dan melapor ke guru membantu semua orang mengambil keputusan yang lebih aman dan terkoordinasi.' },
                  { poin: 20, label: 'Ikuti arahan guru menuju titik kumpul, sambil membantu menenangkan teman yang sedang panik.', feedback: '✅ BAIK! Mengikuti arahan sekaligus membantu teman yang panik menunjukkan kepedulian yang baik terhadap sesama.' },
                  { poin: 15, label: 'Mengemasi semua barang di tasmu dulu sebelum keluar kelas, supaya tidak ada yang tertinggal.', feedback: '👍 CUKUP BENAR! Barang memang penting, tapi menunda keluar kelas saat air terus naik membuang waktu yang berharga.' },
                  { poin: 10, label: 'Berlari sendiri keluar kelas secepat mungkin tanpa menunggu arahan guru.', feedback: '💡 Berlari sendiri tanpa arahan berisiko membuatmu salah arah atau terpisah dari rombongan yang lebih aman.' },
              ]
          },
  
          {{-- ============================================================ --}}
          {{-- FASE 2 — CABANG EVAKUASI (termasuk jalur bahaya ke sungai)   --}}
          {{-- ============================================================ --}}
  
          cabang1: {
              type: 'cabang',
              location: 'sekolah',
              pertanyaan: 'Bu Guru mengarahkan evakuasi. Ke mana sebaiknya kalian pergi?',
              pilihan: [
                  { icon: '🚩', label: 'Menuju Titik Kumpul', next: 'titik_kumpul_tiba' },
                  { icon: '🏠', label: 'Kembali ke Rumah Dulu', next: 'rumah_dilarang' },
                  { icon: '⚠️', label: 'Melihat Kondisi Sungai dari Dekat', next: 'peringatan_sungai', xp: -10 },
              ]
          },
  
          rumah_dilarang: {
              type: 'narasi',
              location: 'rumah',
              text: 'Tunggu! Rumah sudah mulai terendam air. Bu Guru memanggil kalian untuk segera kembali dan menuju titik kumpul evakuasi bersama warga lainnya.',
              next: 'cabang1'
          },
  
          peringatan_sungai: {
              type: 'cabang',
              location: 'sungai',
              pertanyaan: '⚠️ Kamu baru saja melakukan tindakan yang berbahaya! Air sungai bisa naik tiba-tiba tanpa peringatan. Apa yang kamu lakukan sekarang?',
              pilihan: [
                  { icon: '🌊', label: 'Tetap lanjut melihat sungai dari dekat', next: 'air_naik_drastis' },
                  { icon: '🚩', label: 'Segera kembali menuju titik kumpul', next: 'titik_kumpul_tiba' },
              ]
          },
  
          air_naik_drastis: {
              type: 'event',
              location: 'sungai',
              banner: { text: '🌊 Air tiba-tiba naik drastis, arusnya sangat kuat!', icon: '🌊', duration: 2400 },
              heartLoss: 1,
              text: 'Arus air tiba-tiba menjadi sangat deras dan tinggi. Kamu tidak sempat menghindar...',
              next: 'ending_tenggelam'
          },
  
          ending_tenggelam: {
              type: 'ending',
              bad: true,
              location: 'sungai',
              judul: 'MISI GAGAL',
              pesan: 'Air sungai bisa naik sangat cepat dan tanpa peringatan. Karena itu, jangan pernah mendekati aliran sungai saat kondisi banjir, meskipun terlihat masih aman.'
          },
  
          {{-- ============================================================ --}}
          {{-- FASE 3 — TITIK KUMPUL                                        --}}
          {{-- ============================================================ --}}
  
          titik_kumpul_tiba: {
              type: 'narasi',
              location: 'titik_kumpul',
              text: 'Kalian berjalan mengikuti jalur evakuasi menuju titik kumpul bersama warga dan teman-teman sekolah lainnya.',
              next: 'event1'
          },
  
          event1: {
              type: 'event',
              location: 'titik_kumpul',
              banner: { text: '🌊 Air tiba-tiba naik lebih cepat dari perkiraan!', icon: '🌊', duration: 2200 },
              text: 'Warga yang berkumpul mulai panik. Beberapa dari mereka berdesakan menuju tempat yang lebih tinggi.',
              next: 'quiz2'
          },
  
          quiz2: {
              type: 'quiz',
              location: 'titik_kumpul',
              scenario: 'Air tiba-tiba naik lebih cepat dari perkiraan. Beberapa warga mulai berdesakan dan ada yang hendak kembali ke rumah untuk mengambil barang yang tertinggal.',
              ipa: 'Saat banjir naik cepat, tempat yang lebih tinggi jauh lebih aman daripada menunggu di tempat rendah. Kepanikan massal juga bisa menyebabkan orang terjatuh atau terinjak-injak.',
              pertanyaan: 'Melihat kondisi ini, apa yang sebaiknya kamu lakukan?',
              next: 'narasi_guru_izin',
              pilihan: [
                  { poin: 25, label: 'Tetap tenang, ajak warga di sekitarmu untuk segera bergerak ke tempat yang lebih tinggi tanpa berdesakan.', feedback: '⭐ TERBAIK! Tetap tenang sambil mengajak orang lain bergerak bersama ke tempat tinggi adalah keputusan paling aman.' },
                  { poin: 20, label: 'Segera pindah sendiri ke tempat yang lebih tinggi, lalu beri tahu warga terdekat untuk mengikuti.', feedback: '✅ BAIK! Berpindah ke tempat aman itu tepat, akan lebih baik lagi jika dilakukan sambil membantu mengarahkan orang lain sejak awal.' },
                  { poin: 15, label: 'Menunggu sebentar di tempat semula sampai suasana lebih tenang, baru bergerak ke tempat tinggi.', feedback: '👍 CUKUP BENAR! Menunggu terlalu lama saat air terus naik cukup berisiko, sebaiknya segera bergerak begitu tanda bahaya terlihat.' },
                  { poin: 10, label: 'Menyusul warga yang ingin kembali ke rumah untuk mengambil barang yang tertinggal.', feedback: '💡 Kembali ke rumah saat air naik cepat sangat berbahaya — barang bisa diganti, tapi keselamatan jiwa tidak.' },
              ]
          },
  
          narasi_guru_izin: {
              type: 'dialog',
              tokoh: 'reka',
              location: 'titik_kumpul',
              text: 'Untungnya air di sini belum terlalu tinggi. Bu Guru mengizinkan kita pulang, asalkan tetap didampingi dan berhati-hati di jalan.',
              next: 'perjalanan_pulang'
          },
  
          {{-- ============================================================ --}}
          {{-- FASE 4 — PERJALANAN PULANG & MENOLONG WARGA                  --}}
          {{-- ============================================================ --}}
  
          perjalanan_pulang: {
              type: 'narasi',
              location: 'rumah',
              banner: { text: '🚶 Kalian berjalan pulang melewati jalur evakuasi...', icon: '🚶', duration: 2000 },
              text: 'Kalian berjalan pulang bersama beberapa warga, melewati jalanan yang mulai tergenang air setinggi mata kaki.',
              next: 'suara_tolong'
          },
  
          suara_tolong: {
              type: 'event',
              location: 'rumah',
              banner: { text: '😨 Terdengar suara minta tolong dari salah satu rumah warga!', icon: '😨', duration: 2400 },
              text: '“Tolong! Tolong!” — sayup-sayup terdengar suara seseorang meminta bantuan dari salah satu rumah di dekat jalan.',
              next: 'cabang2'
          },
  
          cabang2: {
              type: 'cabang',
              location: 'rumah',
              pertanyaan: 'Apa yang kamu lakukan mendengar suara minta tolong itu?',
              pilihan: [
                  { icon: '🙋', label: 'Berhenti dan memberi tahu orang dewasa terdekat untuk menolong', next: 'quiz3' },
                  { icon: '🚶', label: 'Lanjut berjalan pulang tanpa menghiraukannya', next: 'sampai_rumah', xp: -10 },
              ]
          },
  
          quiz3: {
              type: 'quiz',
              location: 'rumah',
              scenario: 'Ternyata suara itu berasal dari seorang warga yang kesulitan keluar karena pintu rumahnya tersangkut akibat air. Beberapa orang dewasa di sekitarmu bergegas membantu.',
              ipa: 'Anak-anak sebaiknya tidak masuk ke air banjir sendirian untuk menolong, karena arus dan kedalaman air bisa berbahaya dan tidak terlihat jelas dari luar.',
              pertanyaan: 'Sebagai anak-anak, apa peran terbaik yang bisa kamu lakukan untuk membantu?',
              next: 'sampai_rumah',
              pilihan: [
                  { poin: 25, label: 'Segera memberi tahu orang dewasa terdekat dan menunjukkan lokasi suara tersebut, lalu menjauh dari air.', feedback: '⭐ TERBAIK! Melapor ke orang dewasa adalah cara paling aman dan efektif untuk membantu tanpa membahayakan dirimu.' },
                  { poin: 20, label: 'Berteriak memberi semangat pada warga tersebut sambil menunggu orang dewasa datang menolong.', feedback: '✅ BAIK! Memberi semangat itu baik, tapi pastikan kamu tetap di tempat aman dan tidak mendekati air lebih jauh.' },
                  { poin: 15, label: 'Mencoba mendekat sedikit untuk melihat kondisinya lebih jelas sebelum memanggil bantuan.', feedback: '👍 CUKUP BENAR! Rasa pedulimu bagus, tapi mendekati air banjir sendirian tetap berisiko meskipun hanya untuk melihat.' },
                  { poin: 10, label: 'Masuk sendiri ke halaman yang tergenang air untuk mencoba menolong secara langsung.', feedback: '💡 Menolong langsung tanpa bantuan orang dewasa sangat berisiko — kamu bisa ikut terjebak atau terluka.' },
              ]
          },
  
          {{-- ============================================================ --}}
          {{-- FASE 5 — DI RUMAH: INFO BAHAYA & KEPUTUSAN EVAKUASI          --}}
          {{-- ============================================================ --}}
  
          sampai_rumah: {
              type: 'narasi',
              location: 'rumah',
              text: 'Akhirnya kalian sampai di rumah dengan selamat. Keluarga menyambut dengan lega, tapi hujan di luar masih belum juga reda.',
              next: 'info_radio'
          },
  
          info_radio: {
              type: 'event',
              location: 'rumah',
              banner: { text: '📻 Informasi darurat: air diperkirakan akan terus naik!', icon: '📻', duration: 2400 },
              text: 'Radio darurat menyiarkan pengumuman: ketinggian air sungai diperkirakan akan terus naik dalam beberapa jam ke depan dan berpotensi membahayakan pemukiman.',
              next: 'keputusan_evakuasi'
          },
  
          keputusan_evakuasi: {
              type: 'dialog',
              tokoh: 'reka',
              location: 'rumah',
              text: 'Ayah bilang kita harus segera mengungsi ke posko yang ada di bukit sebelum air semakin tinggi. Ayo kita siapkan tas siaga dulu!',
              next: 'quiz_barang'
          },
  
          {{-- ============================================================ --}}
          {{-- FASE 6 — TAS SIAGA BENCANA (MULTISELECT)                     --}}
          {{-- ============================================================ --}}
  
          quiz_barang: {
              type: 'multiselect',
              location: 'rumah',
              scenario: 'Waktu sebelum berangkat sangat terbatas. Kamu hanya bisa membawa satu tas kecil berisi barang-barang paling penting untuk bertahan selama di posko pengungsian.',
              pertanyaan: 'Pilih barang-barang yang perlu kamu masukkan ke dalam tas siaga bencana!',
              next: 'menuju_bukit',
              items: [
                  { id: 'dokumen', emoji: '📄', label: 'Dokumen penting (KTP, KK, surat berharga)', correct: true },
                  { id: 'obat', emoji: '💊', label: 'Obat-obatan pribadi & P3K', correct: true },
                  { id: 'air', emoji: '💧', label: 'Air minum & makanan ringan tahan lama', correct: true },
                  { id: 'senter', emoji: '🔦', label: 'Senter & baterai cadangan', correct: true },
                  { id: 'baju', emoji: '👕', label: 'Pakaian ganti secukupnya', correct: true },
                  { id: 'mainan', emoji: '🧸', label: 'Mainan kesayangan', correct: false },
                  { id: 'tv', emoji: '📺', label: 'TV kecil', correct: false },
                  { id: 'sepeda', emoji: '🚲', label: 'Sepeda', correct: false },
              ]
          },
  
          {{-- ============================================================ --}}
          {{-- FASE 7 — PERJALANAN & KONDISI DI POSKO BUKIT                 --}}
          {{-- ============================================================ --}}
  
          menuju_bukit: {
              type: 'narasi',
              location: 'posko_bukit',
              banner: { text: '🚶 Kalian berjalan menuju posko pengungsian di bukit...', icon: '🏕️', duration: 2200 },
              text: 'Dengan tas siaga di punggung, kalian dan keluarga berjalan menuju posko pengungsian yang berada di daerah lebih tinggi.',
              next: 'kondisi_posko'
          },
  
          kondisi_posko: {
              type: 'narasi',
              location: 'posko_bukit',
              text: 'Sesampainya di sana, posko terlihat sudah penuh sesak. Banyak warga dari berbagai daerah juga ikut mengungsi ke tempat yang sama.',
              next: 'cabang3'
          },
  
          cabang3: {
              type: 'cabang',
              location: 'posko_bukit',
              pertanyaan: 'Posko ini penuh sesak dan cukup ramai. Apa yang sebaiknya kalian lakukan?',
              pilihan: [
                  { icon: '🏕️', label: 'Tetap bertahan di posko ini bersama warga lain', next: 'tanya_nenek' },
                  { icon: '🔍', label: 'Mencari posko lain yang tidak terlalu ramai', next: 'tanya_nenek' },
              ]
          },
  
          tanya_nenek: {
              type: 'dialog',
              tokoh: 'reka',
              location: 'posko_bukit',
              text: 'Lihat, ada Nenek Aminah di rombongan kita. Beliau terlihat kelelahan berjalan sejauh ini. Ayah bertanya, sanggupkah kita membantu memapah beliau?',
              next: 'quiz4'
          },
  
          quiz4: {
              type: 'quiz',
              location: 'posko_bukit',
              scenario: 'Nenek Aminah berjalan tertatih-tatih karena kelelahan dan usianya yang sudah lanjut. Beberapa warga lain sedang sibuk mengurus barang bawaan masing-masing.',
              ipa: 'Lansia dan anak-anak termasuk kelompok rentan saat bencana karena keterbatasan fisik. Membantu mereka dengan cara yang aman adalah bentuk kepedulian dan kerja sama yang penting.',
              pertanyaan: 'Apa yang sebaiknya kamu lakukan?',
              next: 'sampai_posko',
              pilihan: [
                  { poin: 25, label: 'Membantu memapah Nenek Aminah pelan-pelan sambil meminta bantuan orang dewasa lain agar lebih aman.', feedback: '⭐ TERBAIK! Membantu sambil tetap melibatkan orang dewasa membuat proses menjadi aman untukmu dan untuk nenek.' },
                  { poin: 20, label: 'Membawakan barang bawaan Nenek Aminah supaya beliau bisa berjalan lebih ringan dan mudah.', feedback: '✅ BAIK! Meringankan beban bawaan sangat membantu, meskipun bantuan fisik langsung mungkin masih diperlukan.' },
                  { poin: 15, label: 'Memberi tahu petugas posko bahwa ada lansia yang butuh bantuan, lalu menunggu di tempat.', feedback: '👍 CUKUP BENAR! Melapor ke petugas itu baik, tapi kamu juga tetap bisa membantu langsung selama dilakukan dengan aman.' },
                  { poin: 10, label: 'Membiarkan orang dewasa lain yang menangani karena kamu sibuk merapikan barangmu sendiri.', feedback: '💡 Kepedulian terhadap sesama, terutama yang rentan seperti lansia, penting untuk selalu diutamakan saat bencana.' },
              ]
          },
  
          {{-- ============================================================ --}}
          {{-- FASE 8 — ENDING                                              --}}
          {{-- ============================================================ --}}
  
          sampai_posko: {
              type: 'narasi',
              location: 'posko_bukit',
              banner: { text: '🏕️ Kalian tiba dengan selamat di posko pengungsian.', icon: '🏕️', duration: 2000 },
              text: 'Air perlahan mulai surut di kejauhan. Kalian dan warga lainnya berhasil bertahan dengan aman di posko pengungsian.',
              next: 'reka_akhir'
          },
  
          reka_akhir: {
              type: 'dialog',
              tokoh: 'reka',
              location: 'posko_bukit',
              text: 'Kita berhasil! Terima kasih sudah tetap tenang, saling membantu, dan mengikuti arahan evakuasi.',
              next: 'ending'
          },
  
          ending: {
              type: 'ending',
              location: 'posko_bukit'
          }
  
      },
  
      init() {
          this.goto('start');
      },
  
      node() {
          return this.nodes[this.current];
      },
  
      playerStyle() {
          const p = this.positions[this.node().location];
          return `left:${p.left}; top:${p.top};`;
      },
  
      playerSprite() {
          if (this.walking) {
              return '{{ Vite::asset('resources/images/mascot/reka_jalan.png') }}';
          }
          if (this.expression === 'kaget') {
              return '{{ Vite::asset('resources/images/mascot/reka_kaget.png') }}';
          }
          return '{{ Vite::asset('resources/images/mascot/reka.png') }}';
      },
  
      {{-- ====== BANNER NARASI: pengganti "animasi rumit" jadi teks transisi dramatis ====== --}}
      showBanner(text, icon = '⚠️', duration = 2000) {
          return new Promise((resolve) => {
              this.banner = { text, icon };
              setTimeout(() => {
                  this.banner = null;
                  resolve();
              }, duration);
          });
      },
  
      updateWeather(id) {
  
          switch (id) {
  
              case 'start':
                  this.weather.rain = 10;
                  this.weather.water = 0;
                  this.weather.storm = false;
                  break;
  
              case 'hujan_mulai':
                  this.weather.rain = 45;
                  break;
  
              case 'lantai_basah':
                  this.weather.rain = 55;
                  this.weather.water = 8;
                  break;
  
              case 'quiz1':
                  this.weather.rain = 60;
                  break;
  
              case 'event1':
                  this.weather.rain = 100;
                  this.weather.water = 40;
                  this.weather.storm = true;
                  this.weather.flash = true;
                  setTimeout(() => { this.weather.flash = false; }, 250);
                  break;
  
              case 'narasi_guru_izin':
                  this.weather.rain = 45;
                  this.weather.water = 22;
                  this.weather.storm = false;
                  break;
  
              case 'info_radio':
                  this.weather.rain = 75;
                  this.weather.water = 35;
                  this.weather.storm = true;
                  break;
  
              case 'menuju_bukit':
                  this.weather.rain = 60;
                  this.weather.water = 20;
                  break;
  
              case 'sampai_posko':
                  this.weather.rain = 10;
                  this.weather.water = 0;
                  this.weather.storm = false;
                  break;
  
              case 'air_naik_drastis':
                  this.weather.rain = 100;
                  this.weather.water = 90;
                  this.weather.storm = true;
                  this.weather.flash = true;
                  setTimeout(() => { this.weather.flash = false; }, 250);
                  break;
  
          }
  
      },
  
      typeText(text) {
          clearInterval(this.typeTimer);
          this.typed = '';
          this.typingDone = false;
          let i = 0;
          this.typeTimer = setInterval(() => {
              this.typed += text[i];
              i++;
              if (i >= text.length) {
                  clearInterval(this.typeTimer);
                  this.typingDone = true;
              }
          }, 22);
      },
  
      skip() {
          clearInterval(this.typeTimer);
          this.typed = this.node().text;
          this.typingDone = true;
      },
  
      async goto(id) {
  
          this.feedback = null;
          const targetNode = this.nodes[id];
          const prevLocation = this.node().location;
  
          {{-- tampilkan banner narasi dulu (kalau ada) SEBELUM pindah node --}}
          if (targetNode.banner) {
              await this.showBanner(targetNode.banner.text, targetNode.banner.icon, targetNode.banner.duration);
          }
  
          this.current = id;
          const n = targetNode;
  
          if (n.location !== prevLocation) {
              this.walking = true;
              setTimeout(() => { this.walking = false; }, 1000);
          }
  
          if (!this.visited.includes(n.location)) {
              this.visited.push(n.location);
          }
  
          if (n.heartLoss) {
              this.hearts = Math.max(0, this.hearts - n.heartLoss);
          }
  
          {{-- ekspresi otomatis sesuai tipe node --}}
          if (n.type === 'dialog') this.expression = 'normal';
          if (n.type === 'event') this.expression = 'kaget';
          if (n.type === 'quiz' || n.type === 'multiselect') this.expression = 'bingung';
  
          {{-- shake sebentar pas kejadian mendadak --}}
          if (n.type === 'event') {
              this.shake = true;
              setTimeout(() => { this.shake = false; }, 500);
          }
  
          {{-- karakter di panel dialog "masuk" tiap dialog baru --}}
          this.speakerScale = false;
          setTimeout(() => { this.speakerScale = true; }, 150);
  
          if (n.type === 'narasi' || n.type === 'dialog' || n.type === 'event') {
              this.typeText(n.text);
          } else {
              this.typingDone = true;
          }
  
          if (n.type === 'multiselect') {
              this.selectedItems = [];
          }
  
          this.updateWeather(id);
  
          if (n.type === 'ending') {
              this.simpanHasil(n.bad === true);
          }
      },
  
      {{-- Soal bertingkat (poin 25/20/15/10), semua pilihan tetap lanjut ke node berikutnya --}}
      pilih(opt) {
          this.xp += opt.poin;
          this.feedback = {
              poin: opt.poin,
              text: opt.feedback,
              next: this.node().next
          };
      },
  
      {{-- Cabang dengan opsi yang punya konsekuensi poin (misal jalur berbahaya) --}}
      pilihCabang(opt) {
          if (opt.xp) {
              this.xp = Math.max(0, this.xp + opt.xp);
          }
          this.goto(opt.next);
      },
  
      {{-- Multiselect: tas siaga bencana --}}
      toggleItem(id) {
          const idx = this.selectedItems.indexOf(id);
          if (idx === -1) {
              this.selectedItems.push(id);
          } else {
              this.selectedItems.splice(idx, 1);
          }
      },
  
      submitBarang() {
          const items = this.node().items;
          const totalCorrect = items.filter(i => i.correct).length;
          let correctCount = 0;
          let wrongCount = 0;
  
          this.selectedItems.forEach(id => {
              const item = items.find(i => i.id === id);
              if (item.correct) correctCount++;
              else wrongCount++;
          });
  
          const poin = Math.max(0, (correctCount * 10) - (wrongCount * 5));
          let text = '';
  
          if (correctCount === totalCorrect && wrongCount === 0) {
              text = '⭐ SEMPURNA! Kamu memilih semua barang penting untuk tas siaga bencana.';
          } else if (wrongCount === 0 && correctCount >= totalCorrect - 1) {
              text = '✅ BAGUS! Sebagian besar barang pentingmu sudah tepat.';
          } else if (wrongCount > 0) {
              text = '💡 Beberapa barang yang kamu pilih kurang penting saat kondisi darurat. Prioritaskan dokumen, obat, air, dan penerangan.';
          } else {
              text = '👍 CUKUP BAIK! Masih ada barang penting yang terlewat, coba diingat lagi lain kali.';
          }
  
          this.xp += poin;
          this.feedback = { poin, text, next: this.node().next };
      },
  
      tierIcon(poin) {
          if (poin >= 25) return '⭐';
          if (poin >= 20) return '✅';
          if (poin >= 15) return '👍';
          return '💡';
      },
  
      tierColor(poin) {
          if (poin >= 25) return 'text-amber-400';
          if (poin >= 20) return 'text-green-400';
          if (poin >= 15) return 'text-blue-400';
          return 'text-purple-400';
      },
  
      badge() {
          if (this.xp >= 90) return { icon: '🏅', label: 'Penyelamat Hebat' };
          if (this.xp >= 50) return { icon: '🎖️', label: 'Sahabat Siaga' };
          return { icon: '🛡️', label: 'Pemberani Cilik' };
      },
  
      resetGame() {
          this.xp = 0;
          this.hearts = 3;
          this.visited = ['sekolah'];
          this.selectedItems = [];
          this.banner = null;
          this.weather = { rain: 10, water: 0, storm: false, flash: false };
          this.goto('start');
      },
  
      {{-- BARU: kirim hasil akhir ke server --}}
      async simpanHasil(gagal = false) {
          try {
              await fetch('{{ route('siswa.simulasi.selesai') }}', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': '{{ csrf_token() }}'
                  },
                  body: JSON.stringify({
                      skor: this.xp,
                      status: gagal ? 'gagal' : 'selesai',
                  })
              });
          } catch (e) {
              console.error('Gagal menyimpan hasil simulasi', e);
          }
      }
  }" class="flex h-screen gap-5 overflow-hidden bg-slate-100 p-5">

    {{-- ====================== KIRI: PETA (FULL, FOKUS) ====================== --}}
    <div class="relative flex h-full flex-1 flex-col overflow-hidden rounded-3xl bg-sky-100 shadow-2xl">

      {{-- Top bar --}}
      <div class="relative z-30 flex shrink-0 items-center justify-between bg-white/90 px-6 py-3 shadow-md backdrop-blur">

        <a href="/siswa/simulasi" class="rounded-full bg-slate-100 px-4 py-1.5 text-sm font-bold text-slate-500 transition hover:text-blue-600">
          ← Keluar
        </a>

        <div class="rounded-full bg-blue-50 px-5 py-1.5 text-center text-sm font-black text-blue-700">
          🌊 MISI BANJIR
        </div>

        <button @click="resetGame()" class="rounded-full bg-slate-100 px-4 py-1.5 text-sm font-bold text-slate-500 transition hover:text-blue-600">
          ↺ Ulangi Simulasi
        </button>

      </div>

      {{-- ====== AREA PETA: sekarang full height, ga ada panel bawah lagi ====== --}}
      <div class="relative min-h-0 flex-1 overflow-hidden" style="background: linear-gradient(180deg, #bfe8ff 0%, #9bd6ff 35%, #8fd3ff 100%);">

        {{-- OVERLAY: Skor, Progres & Nyawa ngambang di peta --}}
        <div class="pointer-events-none absolute right-4 top-4 z-20 flex flex-col items-end gap-2">

          <div class="pointer-events-auto flex items-center gap-1.5 rounded-full bg-white/90 px-4 py-1.5 text-lg shadow-lg backdrop-blur">
            <template x-for="i in 3" :key="i">
              <span x-text="i <= hearts ? '❤️' : '🤍'"></span>
            </template>
          </div>

          <div class="pointer-events-auto flex items-center gap-3 rounded-full bg-white/90 px-4 py-1.5 text-xs font-black shadow-lg backdrop-blur">
            <span class="text-amber-500">⭐ <span x-text="xp"></span> XP</span>
            <span class="h-3 w-px bg-slate-300"></span>
            <span class="text-blue-600">📍 <span x-text="visited.length"></span>/4</span>
          </div>

        </div>

        {{-- wrapper buat nyentering map-frame --}}
        <div class="absolute inset-0 flex items-center justify-center">

          <div class="relative inline-block h-[90%]">

            {{-- z0: PETA --}}
            <img src="{{ Vite::asset('resources/images/mascot/peta.png') }}" alt="Peta Evakuasi" class="block h-full w-auto select-none"
              onerror="this.style.display='none'">

            {{-- z1: awan --}}
            <div class="pointer-events-none absolute inset-0 z-[1] overflow-hidden opacity-20 blur-sm">
              <img src="{{ Vite::asset('resources/images/mascot/awan.png') }}" class="animate-game-cloud absolute left-6 top-8 w-72">
              <img src="{{ Vite::asset('resources/images/mascot/awan.png') }}" class="animate-game-cloud-slow absolute right-0 top-24 w-96">
            </div>

            {{-- z2: petir --}}
            <img x-show="weather.storm" x-transition.opacity src="{{ Vite::asset('resources/images/mascot/petir.png') }}"
              class="absolute left-[14%] top-[28%] z-[2] w-24 animate-pulse">
            <img x-show="weather.storm" x-transition.opacity src="{{ Vite::asset('resources/images/mascot/petir.png') }}"
              class="absolute left-[74%] top-[28%] z-[2] w-24 animate-pulse">

            {{-- z3: daun terbang --}}
            <img src="{{ Vite::asset('resources/images/mascot/daun_terbang.png') }}"
              class="animate-game-leaf pointer-events-none absolute bottom-16 left-0 z-[3] w-14 opacity-50">

            {{-- z4: hujan — 6 tetes, diam di tempat tapi goyang kiri-kanan, durasi & delay divariasikan biar nggak seragam --}}
            <div x-show="weather.rain > 0" class="pointer-events-none absolute inset-0 z-[4] overflow-hidden">
              <img src="{{ Vite::asset('resources/images/mascot/hujan.png') }}" class="animate-game-rain absolute w-24"
                :style="`left:6%; top:4%; opacity:${0.4 + (weather.rain / 100) * 0.55}; animation-duration:1.5s; animation-delay:0s; filter:contrast(1.3) saturate(1.4);`">
              <img src="{{ Vite::asset('resources/images/mascot/hujan.png') }}" class="animate-game-rain absolute w-24"
                :style="`left:24%; top:10%; opacity:${0.4 + (weather.rain / 100) * 0.55}; animation-duration:1.3s; animation-delay:.2s; filter:contrast(1.3) saturate(1.4);`">
              <img src="{{ Vite::asset('resources/images/mascot/hujan.png') }}" class="animate-game-rain absolute w-24"
                :style="`left:44%; top:3%; opacity:${0.4 + (weather.rain / 100) * 0.55}; animation-duration:1.6s; animation-delay:.4s; filter:contrast(1.3) saturate(1.4);`">
              <img src="{{ Vite::asset('resources/images/mascot/hujan.png') }}" class="animate-game-rain absolute w-24"
                :style="`left:62%; top:9%; opacity:${0.4 + (weather.rain / 100) * 0.55}; animation-duration:1.4s; animation-delay:.1s; filter:contrast(1.3) saturate(1.4);`">
              <img src="{{ Vite::asset('resources/images/mascot/hujan.png') }}" class="animate-game-rain absolute w-24"
                :style="`left:80%; top:5%; opacity:${0.4 + (weather.rain / 100) * 0.55}; animation-duration:1.5s; animation-delay:.3s; filter:contrast(1.3) saturate(1.4);`">
              <img src="{{ Vite::asset('resources/images/mascot/hujan.png') }}" class="animate-game-rain absolute w-24"
                :style="`left:92%; top:11%; opacity:${0.4 + (weather.rain / 100) * 0.55}; animation-duration:1.3s; animation-delay:.5s; filter:contrast(1.3) saturate(1.4);`">
            </div>

            {{-- z5: genangan air --}}
            <div class="pointer-events-none absolute bottom-0 left-0 z-[5] w-full overflow-hidden opacity-70 transition-all duration-[2500ms]"
              :style="'height:' + weather.water + '%'">
              <img src="{{ Vite::asset('resources/images/mascot/genangan_air.png') }}" class="h-full w-full object-cover">
            </div>

            {{-- z6: titik lokasi --}}
            <template x-for="point in mapPoints" :key="point.key">

              <div class="absolute z-[6] flex -translate-x-1/2 -translate-y-1/2 flex-col items-center transition-all duration-500 group"
                :style="`left:${positions[point.key].left}; top:${positions[point.key].top};`">

                <div class="flex h-8 w-8 items-center justify-center rounded-full text-base shadow-lg transition-all duration-500"
                  :class="visited.includes(point.key) ?
                      'animate-game-pulse bg-blue-600/90 text-white' :
                      'bg-white/60 border border-dashed border-white/80 text-white/70'">
                  <span x-text="point.emoji"></span>
                </div>

                <span :class="visited.includes(point.key) ? 'text-white' : 'text-white/60'"
                  class="mt-1 scale-0 whitespace-nowrap rounded-full px-2 py-0.5 text-[10px] font-bold shadow transition-transform duration-200 group-hover:scale-100"
                  style="background: rgba(15,23,42,.65);" x-text="point.label"></span>

              </div>

            </template>

            {{-- z7: flash pas kejadian mendadak --}}
            <div x-show="weather.flash" class="animate-game-flash pointer-events-none absolute inset-0 z-[7] bg-white"></div>

            {{-- z8: karakter --}}
            <div class="absolute z-[8] -translate-x-1/2 -translate-y-full transition-all duration-1000 ease-in-out" :style="playerStyle()">
              <div class="relative flex flex-col items-center">
                <span x-show="walking" x-transition.opacity class="absolute -top-6 text-xs font-bold text-blue-100">🚶</span>
                <img :src="playerSprite()" alt="Pemain" class="h-[72px] animate-game-player transition-all duration-500"
                  style="filter: drop-shadow(0 10px 15px rgba(0,0,0,.35));">
              </div>
            </div>

            {{-- z9: BANNER NARASI — pengganti animasi rumit, dipakai untuk transisi dramatis --}}
            <div x-show="banner" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 scale-95"
              x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-400" x-transition:leave-end="opacity-0"
              class="absolute inset-0 z-[9] flex flex-col items-center justify-center gap-3 bg-slate-900/80 px-8 text-center backdrop-blur-sm">
              <div class="text-6xl" x-text="banner ? banner.icon : ''"></div>
              <p class="text-lg font-black leading-relaxed text-white" x-text="banner ? banner.text : ''"></p>
            </div>

          </div>

        </div>

      </div>

    </div>

    {{-- ====================== KANAN: PANEL CERITA/QUIZ + JEJAK RUTE ====================== --}}
    <aside class="hidden w-[420px] shrink-0 flex-col gap-5 lg:flex">

      {{-- PANEL INTERAKSI (dulunya panel bawah di kiri, sekarang di sini) --}}
      <div class="relative flex-1 overflow-y-auto rounded-3xl p-6 shadow-2xl" style="background: rgba(15,23,42,.92);"
        :class="shake ? 'animate-game-shake' : ''">

        {{-- NARASI / DIALOG / EVENT --}}
        <template x-if="!banner && ['narasi','dialog','event'].includes(node().type)">
          <div>

            <p x-show="node().type === 'event'" class="mb-2 inline-block rounded-full bg-red-500/20 px-4 py-1 text-sm font-black text-red-300">
              ⚠️ INTERUPSI
            </p>

            <div x-show="node().type === 'dialog'" class="mb-4 flex flex-col items-center gap-2 text-center">

              <img
                :src="node().tokoh == 'aksa' ?
                    '{{ Vite::asset('resources/images/mascot/aksa.png') }}' :
                    '{{ Vite::asset('resources/images/mascot/reka.png') }}'"
                class="h-28 transition-all duration-500" :class="speakerScale ? 'scale-100 opacity-100' : 'scale-75 opacity-0'">

              <div class="flex items-center gap-2">
                <div class="h-3 w-3 rounded-full" :class="node().tokoh == 'aksa' ? 'bg-blue-400' : 'bg-pink-400'"></div>
                <p class="text-lg font-black" :class="node().tokoh == 'aksa' ? 'text-blue-300' : 'text-pink-300'"
                  x-text="node().tokoh=='aksa' ? 'Aska' : 'Reka'"></p>
              </div>

            </div>

            <div class="min-w-0">

              <p @click="skip()" class="cursor-pointer whitespace-pre-line text-[17px] leading-8 text-slate-100" x-text="typed"></p>

              <div x-show="!typingDone" class="mt-3 flex items-center gap-2 text-sm text-slate-400">
                <div class="h-2 w-2 rounded-full bg-blue-400 animate-bounce"></div>
                <div class="h-2 w-2 rounded-full bg-blue-400 animate-bounce [animation-delay:.15s]"></div>
                <div class="h-2 w-2 rounded-full bg-blue-400 animate-bounce [animation-delay:.3s]"></div>
              </div>

            </div>

            <button x-show="typingDone" x-transition @click="goto(node().next)"
              class="mt-5 flex w-full items-center justify-center gap-3 rounded-2xl bg-gradient-to-r from-blue-500 to-cyan-500 py-3.5 font-black text-white shadow-xl transition hover:scale-[1.02]">
              Lanjut
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </button>

          </div>
        </template>

        {{-- QUIZ --}}
        <template x-if="!banner && node().type === 'quiz' && !feedback">
          <div>

            <p class="mb-1 text-xs font-black uppercase tracking-wide text-blue-300">📖 Situasi</p>
            <p class="mb-3 rounded-2xl border-l-4 border-blue-400 bg-blue-500/10 p-4 text-sm leading-6 text-slate-100" x-text="node().scenario"></p>

            <p class="mb-3 rounded-2xl border-l-4 border-emerald-400 bg-emerald-500/10 p-4 text-sm leading-6 text-emerald-200" x-text="node().ipa">
            </p>

            <hr class="my-3 border-white/10">

            <p class="text-lg font-black text-white">❓ <span x-text="node().pertanyaan"></span></p>

            <div class="mt-4 flex flex-col gap-2.5">
              <template x-for="(opt, idx) in node().pilihan" :key="idx">
                <button @click="pilih(opt)"
                  class="flex items-start gap-3 rounded-2xl border-2 border-white/10 bg-white/5 p-3.5 text-left transition-all duration-200 hover:-translate-y-0.5 hover:border-blue-400 hover:bg-white/10">
                  <span
                    class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-white/10 font-mono text-xs font-black text-slate-200"
                    x-text="String.fromCharCode(65 + idx)"></span>
                  <span class="text-sm font-semibold leading-6 text-slate-100" x-text="opt.label"></span>
                </button>
              </template>
            </div>

          </div>
        </template>

        {{-- MULTISELECT: TAS SIAGA BENCANA --}}
        <template x-if="!banner && node().type === 'multiselect' && !feedback">
          <div>

            <p class="mb-1 text-xs font-black uppercase tracking-wide text-blue-300">📖 Situasi</p>
            <p class="mb-3 rounded-2xl border-l-4 border-blue-400 bg-blue-500/10 p-4 text-sm leading-6 text-slate-100" x-text="node().scenario"></p>

            <p class="text-lg font-black text-white mb-3">🎒 <span x-text="node().pertanyaan"></span></p>

            <div class="grid grid-cols-2 gap-2.5">
              <template x-for="item in node().items" :key="item.id">
                <button @click="toggleItem(item.id)"
                  class="flex flex-col items-center gap-1.5 rounded-2xl border-2 p-3 text-center transition-all duration-200"
                  :class="selectedItems.includes(item.id) ? 'border-blue-400 bg-blue-500/20' : 'border-white/10 bg-white/5 hover:border-white/30'">
                  <span class="text-3xl" x-text="item.emoji"></span>
                  <span class="text-xs font-semibold leading-tight text-slate-100" x-text="item.label"></span>
                  <span x-show="selectedItems.includes(item.id)" class="text-blue-300 font-black text-sm">✓</span>
                </button>
              </template>
            </div>

            <button @click="submitBarang()"
              class="mt-5 flex w-full items-center justify-center gap-3 rounded-2xl bg-gradient-to-r from-blue-500 to-cyan-500 py-3.5 font-black text-white shadow-xl transition hover:scale-[1.02]">
              🎒 Siap Berangkat
            </button>

          </div>
        </template>

        {{-- CABANG --}}
        <template x-if="!banner && node().type === 'cabang'">
          <div>

            <p class="text-lg font-black text-white" x-text="node().pertanyaan"></p>

            <div class="mt-4 grid gap-3">
              <template x-for="opt in node().pilihan" :key="opt.label">
                <button @click="pilihCabang(opt)"
                  class="rounded-2xl border-2 border-white/10 bg-white/5 p-5 text-center transition-all duration-300 hover:-translate-y-1 hover:border-green-400 hover:bg-white/10">
                  <div class="text-4xl" x-text="opt.icon"></div>
                  <p class="mt-2 font-bold text-slate-100" x-text="opt.label"></p>
                </button>
              </template>
            </div>

          </div>
        </template>

        {{-- FEEDBACK (dipakai bareng untuk quiz & multiselect) --}}
        <template x-if="!banner && feedback">
          <div class="text-center">

            <div class="text-5xl" x-text="tierIcon(feedback.poin)"></div>

            <p class="mt-3 text-base font-bold" :class="tierColor(feedback.poin)" x-text="feedback.text"></p>

            <p class="mt-2 font-black text-amber-400">
              +<span x-text="feedback.poin"></span> Poin
            </p>

            <button @click="goto(feedback.next)"
              class="mt-4 w-full rounded-2xl bg-blue-600 py-3.5 font-black text-white shadow-lg transition hover:scale-[1.02] active:scale-[.98]">
              Lanjut →
            </button>

          </div>
        </template>

        {{-- ENDING BAIK dipindah jadi modal terpisah di bawah, biar tampilannya penuh layar --}}

        {{-- ENDING BURUK (misal: tenggelam di sungai) --}}
        <template x-if="!banner && node().type === 'ending' && node().bad">
          <div class="text-center">

            <p class="text-3xl">💧</p>
            <h2 class="mt-2 text-2xl font-black text-red-300" x-text="node().judul"></h2>

            <p class="mt-3 rounded-2xl border-l-4 border-red-400 bg-red-500/10 p-4 text-sm leading-6 text-slate-100" x-text="node().pesan"></p>

            <p class="mt-3 font-black text-amber-400">
              XP terkumpul: <span x-text="xp"></span>
            </p>

            <div class="mt-6 flex gap-3">
              <button @click="resetGame()" class="flex-1 rounded-xl bg-blue-600 py-2.5 text-sm font-bold text-white transition hover:bg-blue-700">
                Coba Lagi
              </button>
              <a href="/siswa/simulasi"
                class="flex-1 rounded-xl border-2 border-slate-400 py-2.5 text-center text-sm font-bold text-slate-300 transition hover:bg-white/10">
                Kembali
              </a>
            </div>

          </div>
        </template>

      </div>

    </aside>

    {{-- ====================== MODAL LAPORAN AKHIR (EVAKUASI BERHASIL) ====================== --}}
    <template x-if="!banner && node().type === 'ending' && !node().bad">
      <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/70 p-6 backdrop-blur-sm">
        <div class="w-full max-w-md rounded-3xl bg-[#FBF3E4] p-8 text-center shadow-2xl">

          <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-emerald-500 text-4xl font-black text-white shadow-lg">
            ✓
          </div>

          <h2 class="mt-5 text-2xl font-black text-slate-800">Evakuasi Berhasil!</h2>
          <p class="mt-1 text-xs font-black uppercase tracking-wide text-emerald-600" x-text="badge().icon + ' ' + badge().label"></p>

          {{-- SKOR & CHECKPOINT --}}
          <div class="mt-6 grid grid-cols-2 gap-3">
            <div class="rounded-2xl border-2 border-amber-200/60 bg-white/50 p-4">
              <p class="text-2xl font-black text-amber-500" x-text="xp"></p>
              <p class="text-xs font-bold text-slate-400">Skor Soal</p>
            </div>
            <div class="rounded-2xl border-2 border-amber-200/60 bg-white/50 p-4">
              <p class="text-2xl font-black text-blue-600" x-text="visited.length"></p>
              <p class="text-xs font-bold text-slate-400">Checkpoint</p>
            </div>
          </div>

          {{-- PROFIL KARAKTER --}}
          <div class="mt-6 rounded-2xl bg-white/50 p-5 text-left">
            <p class="mb-3 text-sm font-black text-slate-600">🛡️ Profil Karakter</p>

            <div class="mb-3">
              <div class="mb-1 flex items-center justify-between text-xs font-bold text-slate-500">
                <span>Kepedulian Sosial</span>
                <span x-text="Math.min(100, Math.round((xp / 100) * 100)) + '%'"></span>
              </div>
              <div class="h-2 rounded-full bg-slate-200">
                <div class="h-2 rounded-full bg-blue-500 transition-all duration-700" :style="`width:${Math.min(100, (xp / 100) * 100)}%`"></div>
              </div>
            </div>

            <div>
              <div class="mb-1 flex items-center justify-between text-xs font-bold text-slate-500">
                <span>Kehati-hatian</span>
                <span x-text="hearts + '/3'"></span>
              </div>
              <div class="h-2 rounded-full bg-slate-200">
                <div class="h-2 rounded-full bg-rose-400 transition-all duration-700" :style="`width:${(hearts / 3) * 100}%`"></div>
              </div>
            </div>
          </div>

          {{-- RUTE YANG DITEMPUH --}}
          <div class="mt-6 text-left">
            <p class="mb-3 text-sm font-black text-slate-600">🚩 Rute yang Ditempuh</p>
            <div class="flex flex-wrap gap-2">
              <template x-for="point in mapPoints" :key="point.key">
                <span x-show="visited.includes(point.key)" class="rounded-full bg-emerald-600 px-3 py-1 text-xs font-bold text-white">
                  <span x-text="point.emoji + ' ' + point.label + ' ✓'"></span>
                </span>
              </template>
            </div>
          </div>

          {{-- TOMBOL --}}
          <div class="mt-7 flex gap-3">
            <button @click="resetGame()"
              class="flex-1 rounded-2xl bg-orange-500 py-3 text-sm font-black text-white shadow-lg transition hover:bg-orange-600">
              ↺ Ulangi Simulasi
            </button>
            <a href="/siswa/simulasi"
              class="flex-1 rounded-2xl border-2 border-slate-200 py-3 text-center text-sm font-black text-slate-600 transition hover:bg-slate-50">
              🏠 Kembali ke Awal
            </a>
          </div>

        </div>
      </div>
    </template>

  </section>

@endsection
