@extends('layouts.siswa')

@section('title', 'Misi Gempa')

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
      shake: false,
      banner: null,
      selectedItems: [],
  
      {{-- ====== POSISI KARAKTER DI PETA (persen relatif ke gambar peta) ====== --}}
      positions: {
          lapangan: { left: '60%', top: '70%' },
          sekolah: { left: '76%', top: '48%' },
          rumah: { left: '16%', top: '48%' },
          pegunungan: { left: '8%', top: '15%' },
      },
  
      {{-- ====== CHECKPOINT YANG MUNCUL DI OVERLAY & LAPORAN AKHIR ====== --}}
      mapPoints: [
          { key: 'lapangan', emoji: '⚽', label: 'Lapangan Sekolah' },
          { key: 'sekolah', emoji: '🏫', label: 'Sekolah' },
          { key: 'rumah', emoji: '🏠', label: 'Rumah' },
          { key: 'pegunungan', emoji: '⛰️', label: 'Pengungsian' },
      ],
  
      visited: ['lapangan'],
  
      nodes: {
  
          {{-- ============================================================ --}}
          {{-- FASE 1 — GUNCANGAN PERTAMA DI LAPANGAN SEKOLAH               --}}
          {{-- ============================================================ --}}
  
          start: {
              type: 'narasi',
              location: 'lapangan',
              banner: { text: '🌍 Tanah tiba-tiba bergetar!', icon: '🌍', duration: 2200 },
              text: 'Pagi itu, kalian baru saja selesai berbaris di lapangan sekolah dan sedang berjalan menuju kelas. Tiba-tiba... tanah di bawah kaki kalian bergetar kuat! Gempa bumi terjadi.',
              next: 'panik_event'
          },
  
          panik_event: {
              type: 'event',
              location: 'lapangan',
              text: 'Beberapa temanmu mulai berteriak panik dan berlari kesana-kemari tanpa arah. Ada yang hampir menabrak temannya sendiri karena bingung harus berbuat apa.',
              next: 'guru_instruksi'
          },
  
          guru_instruksi: {
              type: 'event',
              location: 'lapangan',
              banner: { text: '📢 Suara Bu Guru terdengar di tengah kepanikan...', icon: '📢', duration: 2200 },
              text: '“Semuanya tenang! Jangan panik! Cari tempat berlindung sekarang juga!” teriak Bu Guru berusaha menenangkan semua siswa.',
              next: 'quiz1'
          },
  
          {{-- ====== SOAL 1: mau berlindung di mana ====== --}}
          quiz1: {
              type: 'quiz',
              location: 'lapangan',
              scenario: 'Guncangan semakin terasa kuat. Kalian berada di area terbuka dekat gedung sekolah, dan Bu Guru sudah berteriak meminta semua siswa segera berlindung.',
              ipa: 'Saat gempa, penting mencari tempat yang jauh dari benda yang berpotensi jatuh seperti kaca, tiang, atau atap. Area terbuka yang jauh dari bangunan adalah tempat paling aman jika kamu sedang berada di luar ruangan.',
              pertanyaan: 'Ke mana sebaiknya kamu segera berlindung?',
              next: 'gempa_reda1',
              pilihan: [
                  { poin: 25, label: 'Segera merunduk di tengah lapangan terbuka yang jauh dari gedung, tiang, dan pohon, sambil melindungi kepala dengan tas atau tangan.', feedback: '⭐ TERBAIK! Area terbuka jauh dari bangunan adalah tempat paling aman saat gempa terjadi di luar ruangan.' },
                  { poin: 20, label: 'Berlari masuk ke kelas terdekat untuk berlindung di bawah meja yang kokoh.', feedback: '✅ BAIK, tapi berlari saat tanah masih bergetar cukup berisiko membuatmu terjatuh. Sebaiknya tetap di area terbuka dulu sampai guncangan mereda.' },
                  { poin: 15, label: 'Berdiri diam di tempat sambil berpegangan pada teman terdekat.', feedback: '👍 CUKUP BENAR! Diam mengurangi risiko terjatuh, tapi tanpa berlindung kamu tetap berisiko tertimpa benda dari gedung sekitar.' },
                  { poin: 10, label: 'Berlindung di dekat dinding gedung sekolah karena dirasa lebih teduh.', heartLoss: 1, feedback: '💡 Berlindung dekat dinding gedung berisiko tinggi — genting atau bagian bangunan bisa runtuh menimpamu.' },
              ]
          },
  
          gempa_reda1: {
              type: 'narasi',
              location: 'lapangan',
              text: 'Perlahan guncangan mulai mereda. Untungnya, gempa kali ini tidak berskala besar sehingga tidak ada bangunan sekolah yang rusak.',
              next: 'lanjut_belajar'
          },
  
          lanjut_belajar: {
              type: 'narasi',
              location: 'sekolah',
              text: 'Karena kondisi sudah tenang dan aman, Bu Guru mengajak semua siswa kembali masuk ke kelas untuk melanjutkan pelajaran seperti biasa.',
              next: 'jam_istirahat'
          },
  
          {{-- ============================================================ --}}
          {{-- FASE 2 — GEMPA SUSULAN SAAT ISTIRAHAT                        --}}
          {{-- ============================================================ --}}
  
          jam_istirahat: {
              type: 'narasi',
              location: 'lapangan',
              text: 'Waktu berlalu, bel istirahat pun berbunyi. Kalian dan teman-teman keluar kelas untuk bermain dan bersantai di lapangan sekolah.',
              next: 'gempa_susulan'
          },
  
          gempa_susulan: {
              type: 'event',
              location: 'lapangan',
              banner: { text: '🚨 GEMPA SUSULAN! Sirine tanda bahaya berbunyi!', icon: '🚨', duration: 2600 },
              text: 'Tiba-tiba tanah kembali bergetar, kali ini jauh lebih kuat! Sirine tanda bahaya meraung nyaring, menandakan gempa kali ini berskala tinggi.',
              next: 'quiz2'
          },
  
          {{-- ====== SOAL 2: respon terhadap gempa susulan + sirine ====== --}}
          quiz2: {
              type: 'quiz',
              location: 'lapangan',
              scenario: 'Sirine tanda bahaya berbunyi nyaring bersamaan dengan guncangan yang jauh lebih kuat dari sebelumnya. Beberapa gedung sekolah mulai retak dan sebagian genting berjatuhan.',
              ipa: 'Sirine tanda bahaya menunjukkan potensi bahaya besar. Saat mendengarnya bersamaan dengan gempa kuat, segera menjauh dari bangunan dan mencari area terbuka adalah langkah paling aman.',
              pertanyaan: 'Mendengar sirine dan guncangan yang semakin kuat, apa yang sebaiknya kamu lakukan?',
              next: 'narasi_kumpul',
              pilihan: [
                  { poin: 25, label: 'Segera berlari menjauh dari gedung sekolah menuju tengah lapangan yang terbuka, jauh dari reruntuhan.', feedback: '⭐ TERBAIK! Menjauh dari bangunan menuju area terbuka adalah respons paling tepat saat sirine bahaya berbunyi.' },
                  { poin: 20, label: 'Mengikuti teman-teman yang berlari ke lapangan sambil tetap waspada terhadap reruntuhan di sekitar.', feedback: '✅ BAIK! Mengikuti arahan bersama teman sambil tetap waspada adalah sikap yang baik.' },
                  { poin: 15, label: 'Berdiri di dekat gedung sambil menunggu arahan lebih lanjut.', feedback: '👍 CUKUP BENAR! Menunggu arahan tidak sepenuhnya salah, tapi berdiri dekat gedung yang retak cukup berisiko.' },
                  { poin: 10, label: 'Justru berlari mendekati gedung untuk melihat retakan yang terjadi.', heartLoss: 1, feedback: '💡 Mendekati gedung yang retak sangat berbahaya — reruntuhan bisa jatuh kapan saja tanpa peringatan.' },
              ]
          },
  
          narasi_kumpul: {
              type: 'dialog',
              tokoh: 'aksa',
              location: 'lapangan',
              text: 'Semua siswa diminta berkumpul di tengah lapangan terbuka, jauh dari gedung sekolah, sampai keadaan benar-benar aman.',
              next: 'gempa_reda2'
          },
  
          gempa_reda2: {
              type: 'event',
              location: 'lapangan',
              banner: { text: '💨 Guncangan mulai mereda...', icon: '💨', duration: 2200 },
              text: 'Guncangan perlahan mereda. Namun terlihat puing-puing bangunan sekolah berserakan di beberapa sudut lapangan.',
              next: 'pulang_dampingi'
          },
  
          {{-- ============================================================ --}}
          {{-- FASE 3 — PERJALANAN PULANG & MENOLONG WARGA                  --}}
          {{-- ============================================================ --}}
  
          pulang_dampingi: {
              type: 'narasi',
              location: 'rumah',
              text: 'Setelah dipastikan aman, guru-guru mendampingi seluruh siswa untuk pulang ke rumah masing-masing dengan hati-hati.',
              next: 'warga_tolong'
          },
  
          warga_tolong: {
              type: 'event',
              location: 'rumah',
              banner: { text: '😨 Banyak warga terdengar meminta tolong!', icon: '😨', duration: 2400 },
              text: 'Di sepanjang perjalanan pulang, kalian melihat dan mendengar banyak warga yang berteriak minta tolong akibat rumah mereka yang rusak.',
              next: 'quiz3'
          },
  
          {{-- ====== SOAL 3: menolong warga ====== --}}
          quiz3: {
              type: 'quiz',
              location: 'rumah',
              scenario: 'Beberapa warga terlihat kesulitan keluar dari reruntuhan rumah mereka. Ada juga yang terluka ringan dan butuh bantuan segera.',
              ipa: 'Anak-anak sebaiknya tidak masuk ke reruntuhan bangunan karena berisiko roboh susulan. Cara terbaik membantu adalah dengan melapor ke orang dewasa terdekat atau petugas agar bantuan bisa segera datang.',
              pertanyaan: 'Melihat kondisi ini, apa yang sebaiknya kamu lakukan?',
              next: 'sampai_rumah',
              pilihan: [
                  { poin: 25, label: 'Segera memberi tahu orang dewasa atau petugas terdekat tentang lokasi warga yang butuh pertolongan.', feedback: '⭐ TERBAIK! Melapor ke orang dewasa adalah cara paling aman dan efektif untuk membantu tanpa membahayakan dirimu.' },
                  { poin: 20, label: 'Berteriak memberi semangat pada warga tersebut sambil mencari orang dewasa untuk membantu.', feedback: '✅ BAIK! Memberi semangat itu baik, pastikan kamu tetap mencari bantuan orang dewasa secepatnya.' },
                  { poin: 15, label: 'Berhenti sejenak untuk melihat kondisinya lebih jelas sebelum memutuskan mencari bantuan.', feedback: '👍 CUKUP BENAR! Rasa pedulimu bagus, tapi jangan menunda terlalu lama untuk mencari bantuan.' },
                  { poin: 10, label: 'Mencoba masuk sendiri ke reruntuhan untuk menolong warga tersebut.', heartLoss: 1, feedback: '💡 Masuk sendiri ke reruntuhan sangat berisiko — kamu bisa ikut terjebak atau terluka tanpa bantuan orang dewasa.' },
              ]
          },
  
          {{-- ============================================================ --}}
          {{-- FASE 4 — RUMAH ROBOH & MENCARI ORANG TUA                     --}}
          {{-- ============================================================ --}}
  
          sampai_rumah: {
              type: 'event',
              location: 'rumah',
              banner: { text: '😢 Rumah kalian terlihat roboh sebagian!', icon: '😢', duration: 2400 },
              text: 'Sesampainya di rumah, ternyata bangunan rumah kalian roboh sebagian akibat gempa. Kalian berdiri termangu melihat kondisi tersebut.',
              next: 'quiz4'
          },
  
          {{-- ====== SOAL 4: apa yang dilakukan saat rumah roboh ====== --}}
          quiz4: {
              type: 'quiz',
              location: 'rumah',
              scenario: 'Rumah dalam kondisi tidak aman untuk dimasuki. Orang tua kalian belum terlihat di sekitar rumah, sementara beberapa tetangga sedang sibuk memeriksa kondisi rumah masing-masing.',
              ipa: 'Saat rumah rusak akibat gempa, hal terpenting adalah mencari keluarga di tempat yang aman dan tidak masuk ke bangunan yang berpotensi roboh, karena gempa susulan bisa terjadi kapan saja.',
              pertanyaan: 'Apa yang sebaiknya kamu lakukan saat ini?',
              next: 'ketemu_ortu',
              pilihan: [
                  { poin: 25, label: 'Tetap berada di area terbuka dekat rumah sambil mencari dan memanggil-manggil orang tua masing-masing.', feedback: '⭐ TERBAIK! Mencari keluarga di area terbuka yang aman adalah langkah paling tepat setelah gempa besar.' },
                  { poin: 20, label: 'Bertanya kepada tetangga terdekat apakah mereka melihat orang tuamu.', feedback: '✅ BAIK! Bertanya kepada tetangga bisa membantu mempercepat pencarian keluargamu.' },
                  { poin: 15, label: 'Menunggu diam di depan rumah berharap orang tua datang menjemput.', feedback: '👍 CUKUP BENAR! Menunggu tidak sepenuhnya salah, tapi akan lebih baik jika kamu juga aktif mencari sambil tetap di area aman.' },
                  { poin: 10, label: 'Masuk ke dalam rumah yang roboh untuk mencari barang-barang penting.', heartLoss: 1, feedback: '💡 Masuk ke bangunan yang roboh sangat berbahaya — barang bisa diganti, tapi keselamatan jiwa tidak.' },
              ]
          },
  
          ketemu_ortu: {
              type: 'dialog',
              tokoh: 'reka',
              location: 'rumah',
              text: 'Tak lama kemudian, kalian bertemu dengan orang tua yang ternyata sedang mencari kalian juga. Ayah mengajak untuk segera bersiap mengungsi ke daerah pegunungan yang lebih aman.',
              next: 'quiz_barang'
          },
  
          {{-- ============================================================ --}}
          {{-- FASE 5 — TAS SIAGA BENCANA (MULTISELECT)                     --}}
          {{-- ============================================================ --}}
  
          quiz_barang: {
              type: 'multiselect',
              location: 'rumah',
              scenario: 'Waktu sebelum berangkat mengungsi sangat terbatas. Kalian hanya bisa membawa satu tas kecil berisi barang-barang paling penting untuk bertahan selama di pengungsian.',
              pertanyaan: 'Pilih barang-barang yang perlu kamu masukkan ke dalam tas siaga bencana!',
              next: 'menuju_gunung',
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
          {{-- FASE 6 — PENGUNGSIAN DI PEGUNUNGAN                           --}}
          {{-- ============================================================ --}}
  
          menuju_gunung: {
              type: 'narasi',
              location: 'pegunungan',
              banner: { text: '🚶 Kalian dan keluarga menuju pengungsian di pegunungan...', icon: '⛰️', duration: 2200 },
              text: 'Dengan tas siaga di punggung, kalian bersama keluarga berjalan menuju posko pengungsian di daerah pegunungan yang lebih aman dari reruntuhan.',
              next: 'kondisi_posko'
          },
  
          kondisi_posko: {
              type: 'narasi',
              location: 'pegunungan',
              text: 'Sesampainya di sana, posko-posko pengungsian terlihat sudah penuh sesak oleh warga yang mengungsi dari berbagai daerah.',
              next: 'posko_kosong'
          },
  
          {{-- ====== SOAL 5: satu tempat kosong, merelakan atau mempertahankan ====== --}}
          posko_kosong: {
              type: 'quiz',
              location: 'pegunungan',
              scenario: 'Petugas posko menemukan satu tempat kosong yang hanya cukup untuk satu orang. Ada seorang warga lanjut usia yang masih berdiri karena belum kebagian tempat.',
              ipa: 'Sikap saling berbagi dan mendahulukan orang yang lebih membutuhkan, seperti lansia, adalah bentuk kepedulian penting saat kondisi darurat.',
              pertanyaan: 'Melihat kondisi ini, apa yang sebaiknya kamu lakukan?',
              next: 'posko_bantu',
              pilihan: [
                  { poin: 25, label: 'Merelakan tempat tersebut untuk warga lanjut usia itu, karena kamu merasa masih cukup kuat untuk berdiri atau mencari tempat lain.', feedback: '⭐ TERBAIK! Mendahulukan orang yang lebih membutuhkan menunjukkan kepedulian besar terhadap sesama.' },
                  { poin: 10, label: 'Tetap mempertahankan tempat itu untuk dirimu sendiri karena sudah datang lebih dulu.', feedback: '💡 Memikirkan diri sendiri wajar, tapi cobalah lebih peka terhadap orang yang lebih membutuhkan seperti lansia.' },
              ]
          },
  
          {{-- ====== SOAL 6: diam diri atau bantu-bantu di posko ====== --}}
          posko_bantu: {
              type: 'quiz',
              location: 'pegunungan',
              scenario: 'Suasana posko masih ramai dan sibuk. Beberapa petugas serta warga lain terlihat kewalahan mengatur logistik dan menenangkan pengungsi lain yang masih ketakutan.',
              ipa: 'Membantu sesama sesuai kemampuan, seperti menenangkan orang lain atau membantu hal-hal ringan, dapat meringankan beban bersama saat kondisi darurat.',
              pertanyaan: 'Apa yang sebaiknya kamu lakukan selama berada di posko?',
              next: 'kondisi_aman',
              pilihan: [
                  { poin: 25, label: 'Ikut membantu hal-hal ringan seperti menenangkan anak-anak lain atau membantu petugas membagikan logistik.', feedback: '⭐ TERBAIK! Membantu sesuai kemampuan meringankan beban bersama dan menunjukkan kepedulianmu.' },
                  { poin: 10, label: 'Diam saja di sudut posko dan tidak melakukan apa-apa.', feedback: '💡 Beristirahat itu wajar, tapi cobalah ikut membantu hal-hal kecil yang kamu mampu untuk meringankan beban bersama.' },
              ]
          },
  
          {{-- ============================================================ --}}
          {{-- FASE 7 — ENDING                                              --}}
          {{-- ============================================================ --}}
  
          kondisi_aman: {
              type: 'narasi',
              location: 'pegunungan',
              text: 'Waktu terus berlalu, dan kondisi di luar berangsur aman. Petugas menginformasikan bahwa gempa susulan sudah tidak terjadi lagi.',
              next: 'aksa_akhir'
          },
  
          aksa_akhir: {
              type: 'dialog',
              tokoh: 'aksa',
              location: 'pegunungan',
              text: 'Kita berhasil melewati semuanya dengan selamat! Terima kasih sudah tetap tenang, saling membantu, dan mengikuti arahan selama gempa terjadi.',
              next: 'ending'
          },
  
          ending: {
              type: 'ending',
              location: 'pegunungan'
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
  
      {{-- ====== BANNER NARASI: transisi dramatis pas guncangan besar ====== --}}
      showBanner(text, icon = '⚠️', duration = 2000) {
          return new Promise((resolve) => {
              this.banner = { text, icon };
              setTimeout(() => {
                  this.banner = null;
                  resolve();
              }, duration);
          });
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
  
          {{-- guncangan layar sebentar tiap ada kejadian mendadak --}}
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
  
          if (n.type === 'ending') {
              this.simpanHasil();
          }
      },
  
      {{-- Soal bertingkat (poin 25/20/15/10 atau 25/10), semua pilihan tetap lanjut ke node berikutnya --}}
      pilih(opt) {
          this.xp += opt.poin;
          if (opt.heartLoss) {
              this.hearts = Math.max(0, this.hearts - opt.heartLoss);
          }
          this.feedback = {
              poin: opt.poin,
              text: opt.feedback,
              next: this.node().next
          };
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
          if (this.xp >= 140) return { icon: '🏅', label: 'Penyelamat Hebat' };
          if (this.xp >= 80) return { icon: '🎖️', label: 'Sahabat Siaga' };
          return { icon: '🛡️', label: 'Pemberani Cilik' };
      },
  
      resetGame() {
          this.xp = 0;
          this.hearts = 3;
          this.visited = ['lapangan'];
          this.selectedItems = [];
          this.banner = null;
          this.goto('start');
      },
  
      {{-- BARU: kirim hasil akhir ke server --}}
      async simpanHasil() {
          try {
              await fetch('{{ route('siswa.simulasi.selesai') }}', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': '{{ csrf_token() }}'
                  },
                  body: JSON.stringify({
                      skor: this.xp,
                      status: 'selesai',
                  })
              });
          } catch (e) {
              console.error('Gagal menyimpan hasil simulasi', e);
          }
      }
  }" class="flex h-screen gap-5 overflow-hidden bg-slate-100 p-5">

    {{-- ====================== KIRI: PETA (FULL, FOKUS) ====================== --}}
    <div class="relative flex h-full flex-1 flex-col overflow-hidden rounded-3xl bg-sky-100 shadow-2xl" :class="shake ? 'animate-game-shake' : ''">

      {{-- Top bar --}}
      <div class="relative z-30 flex shrink-0 items-center justify-between bg-white/90 px-6 py-3 shadow-md backdrop-blur">

        <a href="/siswa/simulasi" class="rounded-full bg-slate-100 px-4 py-1.5 text-sm font-bold text-slate-500 transition hover:text-blue-600">
          ← Keluar
        </a>

        <div class="rounded-full bg-blue-50 px-5 py-1.5 text-center text-sm font-black text-blue-700">
          🌍 MISI GEMPA
        </div>

        <button @click="resetGame()" class="rounded-full bg-slate-100 px-4 py-1.5 text-sm font-bold text-slate-500 transition hover:text-blue-600">
          ↺ Ulangi Simulasi
        </button>

      </div>

      {{-- ====== AREA PETA: full height, ga ada panel bawah ====== --}}
      <div class="relative min-h-0 flex-1 overflow-hidden" style="background: linear-gradient(180deg, #dce7f0 0%, #c7d9e8 40%, #b9cfe0 100%);">

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

            {{-- z8: karakter --}}
            <div class="absolute z-[8] -translate-x-1/2 -translate-y-full transition-all duration-1000 ease-in-out" :style="playerStyle()">
              <div class="relative flex flex-col items-center">
                <span x-show="walking" x-transition.opacity class="absolute -top-6 text-xs font-bold text-blue-700">🚶</span>
                <img src="{{ Vite::asset('resources/images/mascot/aksa_jalan.png') }}" alt="Pemain"
                  class="h-16 w-16 animate-game-player transition-all duration-500 drop-shadow-xl"
                  onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                <div style="display:none" class="hidden h-16 w-16 items-center justify-center rounded-full bg-blue-600 text-3xl text-white shadow-xl">
                  🧒
                </div>
              </div>
            </div>

            {{-- z9: BANNER NARASI — transisi dramatis pas ada guncangan --}}
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

    {{-- ====================== KANAN: PANEL CERITA/QUIZ ====================== --}}
    <aside class="hidden w-[420px] shrink-0 flex-col gap-5 lg:flex">

      <div class="relative flex-1 overflow-y-auto rounded-3xl p-6 shadow-2xl" style="background: rgba(15,23,42,.92);">

        {{-- NARASI / DIALOG / EVENT --}}
        <template x-if="!banner && ['narasi','dialog','event'].includes(node().type)">
          <div>

            <p x-show="node().type === 'event'" class="mb-2 inline-block rounded-full bg-red-500/20 px-4 py-1 text-sm font-black text-red-300">
              ⚠️ INTERUPSI
            </p>

            <div x-show="node().type === 'dialog'" class="mb-4 flex flex-col items-center gap-2 text-center">

              <img
                :src="node().tokoh === 'aksa' ?
                    '{{ Vite::asset('resources/images/mascot/aksa.png') }}' :
                    '{{ Vite::asset('resources/images/mascot/reka.png') }}'"
                class="h-28 transition-all duration-500" :class="speakerScale ? 'scale-100 opacity-100' : 'scale-75 opacity-0'">

              <div class="flex items-center gap-2">
                <div class="h-3 w-3 rounded-full" :class="node().tokoh === 'aksa' ? 'bg-blue-400' : 'bg-pink-400'"></div>
                <p class="text-lg font-black" :class="node().tokoh === 'aksa' ? 'text-blue-300' : 'text-pink-300'"
                  x-text="node().tokoh === 'aksa' ? 'Aska' : 'Reka'"></p>
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

        {{-- CABANG (disediakan untuk pengembangan lanjutan bila diperlukan) --}}
        <template x-if="!banner && node().type === 'cabang'">
          <div>

            <p class="text-lg font-black text-white" x-text="node().pertanyaan"></p>

            <div class="mt-4 grid gap-3">
              <template x-for="opt in node().pilihan" :key="opt.label">
                <button @click="goto(opt.next)"
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

      </div>

    </aside>

    {{-- ====================== MODAL LAPORAN AKHIR (EVAKUASI BERHASIL) ====================== --}}
    <template x-if="!banner && node().type === 'ending'">
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
                <span>Kesiapsiagaan</span>
                <span x-text="Math.min(100, Math.round((xp / 200) * 100)) + '%'"></span>
              </div>
              <div class="h-2 rounded-full bg-slate-200">
                <div class="h-2 rounded-full bg-blue-500 transition-all duration-700" :style="`width:${Math.min(100, (xp / 200) * 100)}%`"></div>
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
