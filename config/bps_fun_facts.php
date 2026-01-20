<?php

return [
    'title' => 'Fakta Unik BPS & Literasi Statistik',
    'description' => 'Kumpulan informasi ringan, mitos vs fakta, dan penjelasan istilah ekonomi agar mudah dipahami masyarakat awam.',
    'sections' => [
        'fakta_utama' => [
            'label' => '📌 Top 5 Fakta BPS',
            'items' => [
                [
                    'judul' => 'Bukan Cuma Hitung Beras',
                    'isi' => 'Saat menghitung Inflasi, BPS memantau ratusan barang dalam "Keranjang Komoditas", termasuk pulsa, listrik, rokok, hingga skincare!'
                ],
                [
                    'judul' => 'Rumus "Miskin" Bukan Pakai Perasaan',
                    'isi' => 'Ukurannya adalah Kalori. Seseorang dianggap miskin jika pengeluaran per bulannya tidak cukup untuk memenuhi kebutuhan makan 2.100 kalori/hari + kebutuhan dasar non-makanan. Jadi ukurannya bukan punya motor atau tidak, tapi cukup gizi atau tidak.'
                ],
                [
                    'judul' => 'Kitab Suci "Kabupaten Dalam Angka"',
                    'isi' => 'Buku legendaris BPS yang terbit tiap tahun. Isinya rekaman jejak pembangunan setahun penuh (penduduk, panen, pengangguran, dll). Wajib punya bagi mahasiswa dan kontraktor!'
                ],
                [
                    'judul' => 'Sensus Ekonomi = Cek Dompet Negara',
                    'isi' => 'Sensus Ekonomi (tahun berakhiran 6) menghitung "belanja/dompet" seluruh usaha, beda dengan Sensus Penduduk (hitung orang) atau Pertanian (hitung petani).'
                ],
                [
                    'judul' => 'Rahasia Dijamin Undang-Undang',
                    'isi' => 'Petugas BPS disumpah UU Statistik No. 16 Tahun 1997. Data individu DIJAMIN RAHASIA dan tidak akan dibocorkan ke orang pajak atau polisi. BPS hanya merilis angka total/rekapitulasi.'
                ]
            ]
        ],
        'mitos_fakta' => [
            'label' => '📂 Mitos vs Fakta',
            'items' => [
                [
                    'mitos' => 'Kerja sebentar = Pengangguran?',
                    'fakta' => 'Kerja 1 Jam Seminggu = TIDAK Pengangguran. Standar ILO: jika melakukan kegiatan ekonomi min. 1 jam berturut-turut dalam seminggu terakhir, statusnya "Bekerja".'
                ],
                [
                    'mitos' => 'Ada Sensus = Dapat Bantuan?',
                    'fakta' => 'BPS hanya memotret data, bukan pembagi BLT. Kalau data dimanipulasi jadi "miskin semua", program pemerintah bisa salah sasaran (daerah butuh modal malah dikasih raskin).'
                ],
                [
                    'mitos' => 'Petugas BPS Minta Uang?',
                    'fakta' => 'BPS TIDAK PERNAH Minta Uang! Semua layanan pendataan GRATIS. Petugas resmi pakai rompi, kartu identitas, dan surat tugas.'
                ]
            ]
        ],
        'istilah_ekonomi' => [
            'label' => '📂 Istilah Ekonomi (Bahasa Manusia)',
            'items' => [
                [
                    'istilah' => 'PDRB (Kue Rezeki Daerah)',
                    'penjelasan' => 'Total uang yang dihasilkan seluruh aktivitas ekonomi di daerah dalam setahun. Makin besar kuenya -> pertumbuhan ekonomi. Makin besar potongan per orang -> makin makmur.'
                ],
                [
                    'istilah' => 'Kenapa Cabe Rawit "Pedas" di Data?',
                    'penjelasan' => 'Cabe punya bobot inflasi tinggi karena orang Indonesia wajib makan sambal. Kenaikan harga cabe lebih terasa efeknya di "dompet emak-emak" dibanding perabotan.'
                ],
                [
                    'istilah' => 'Garis Kemiskinan itu Lokal',
                    'penjelasan' => 'Miskin di Jakarta beda dengan di Desa. Rp500rb mungkin cukup makan sebulan di desa (tidak miskin), tapi tidak cukup di kota (miskin).'
                ]
            ]
        ],
        'serba_serbi' => [
            'label' => '📂 Serba-Serbi Sensus',
            'items' => [
                [
                    'judul' => 'Jadwal Keramat 0-3-6',
                    'isi' => 'Akhiran 0: Sensus Penduduk. Akhiran 3: Sensus Pertanian. Akhiran 6: Sensus Ekonomi.'
                ],
                [
                    'judul' => 'De Jure vs De Facto',
                    'isi' => 'BPS pakai De Facto (tempat tinggal nyata sekarang), bukan cuma De Jure (KTP). Agar tahu siapa yang butuh layanan di lokasi tersebut.'
                ]
            ]
        ],
        'teknologi' => [
            'label' => '📂 Teknologi & Lapangan',
            'items' => [
                [
                    'judul' => 'Gak Pake Kertas Lagi (CAPI)',
                    'isi' => 'Petugas pakai HP/Tablet (CAPI). Data langsung masuk server. Tapi kalau sinyal susah/lowbatt, ya harus pending dulu.'
                ],
                [
                    'judul' => 'Jangan Bohong Soal Lantai',
                    'isi' => 'Petugas melakukan cross-check fisik. Mulut bisa bilang "susah", tapi lantai marmer dan bangunan mewah tidak bisa bohong.'
                ]
            ]
        ],
        'susenas' => [
            'label' => '📂 Susenas ("The Mother of All Surveys")',
            'items' => [
                [
                    'judul' => 'Survei Paling Kepo',
                    'isi' => 'Susenas (Survei Sosial Ekonomi Nasional) adalah rajanya survei. Petugas nanya detail: "Makan ikan apa? Berapa ons? Beli rokok berapa?". Tujuannya menghitung pengeluaran rakyat sampai ke butir garam untuk data Kemiskinan.'
                ],
                [
                    'judul' => 'Rokok vs Beras',
                    'isi' => 'Fakta Miris: Penyumbang garis kemiskinan terbesar kedua setelah beras adalah ROKOK. Banyak rumah tangga miskin rela kurangi gizi demi rokok. Ini jadi dasar kebijakan cukai dan bansos.'
                ]
            ]
        ],
        'rahasia_ekonomi' => [
            'label' => '📂 Rahasia Dapur Ekonomi',
            'items' => [
                [
                    'judul' => 'Bonus Demografi != Bagi Uang',
                    'isi' => 'Artinya jumlah orang usia produktif (kerja) LEBIH BANYAK daripada orang tua/balita. Kesempatan emas ekonomi lari kencang karena "yang cari duit > yang minta duit".'
                ],
                [
                    'judul' => 'Kenapa "Petani" Makin Sedikit?',
                    'isi' => 'Petani muda makin langka (regenerasi macet). Jika semua jadi YouTuber/buruh pabrik, siapa yang tanam padi? Data ini alarm bahaya ketahanan pangan.'
                ]
            ]
        ],
        'drama_lapangan' => [
            'label' => '📂 Drama Petugas Lapangan (True Story)',
            'items' => [
                [
                    'judul' => 'Musuh Utama = Anjing Galak',
                    'isi' => 'Bukan preman, tapi anjing penjaga. Petugas punya trik: bawa payung atau makanan kucing buat nyogok.'
                ],
                [
                    'judul' => 'Responden "Hantu" (Orang Kaya)',
                    'isi' => 'Rumah gedongan, pagar tinggi, diketuk gak keluar. Padahal pengeluaran mereka besar & penting buat data ekonomi. Tantangan berat sensus di kota besar.'
                ]
            ]
        ],
        'edukasi_singkat' => [
            'label' => '📂 Edukasi Singkat (Biar Pinter)',
            'items' => [
                [
                    'judul' => 'NIK vs Nomor Sensus',
                    'isi' => 'NIK = Identitas Individu (KTP). Nomor Bangunan Sensus = Identitas Lokasi saat survei (biar gak didata dobel/nyasar). Jadi stiker sensus nomornya pasti beda sama NIK.'
                ],
                [
                    'judul' => 'Inflasi = Pencuri Diam-diam',
                    'isi' => 'Kalau harga naik (inflasi), nilai uang di bawah bantal tergerus. BPS pantau harga biar pemerintah bisa ngerem (operasi pasar) kalau harga sembako mulai "ngegas".'
                ]
            ]
        ],
        'trivia' => [
            'label' => '📂 Trivia BPS',
            'items' => [
                [
                    'judul' => 'Desa Potensi (PODES)',
                    'isi' => 'BPS tahu mana desa "Sultan" atau "Tertinggal" (sinyal 4G, jumlah bidan, jenis jalan). Data ini dipakai buat nentuin Dana Desa.'
                ],
                [
                    'judul' => 'Hari Statistik Nasional',
                    'isi' => '26 September. Mengingatkan bahwa "Membangun tanpa data jauh lebih mahal (boros/salah sasaran)."'
                ]
            ]
        ],
        'misteri_tetangga' => [
            'label' => '📂 Misteri Tetangga (Sampling)',
            'items' => [
                [
                    'judul' => 'Kenapa Rumah Tetangga Didata, Saya Enggak?',
                    'isi' => 'Metode Sampling ibarat mencicipi sayur sop. Cukup satu sendok untuk tahu rasa satu panci. Sampel rumah mewakili karakteristik satu wilayah, jadi hasilnya tetap akurat tanpa harus mengetuk semua pintu.'
                ],
                [
                    'judul' => 'Responden Cadangan',
                    'isi' => 'Jika target pindah/meninggal, petugas TIDAK BOLEH asal ganti ke rumah sebelah. Wajib lihat daftar "Cadangan" yang dipilih sistem acak.'
                ]
            ]
        ],
        'realita_sosial' => [
            'label' => '📂 Realita Sosial (Sisi Lain Data)',
            'items' => [
                [
                    'judul' => 'Kaum "Mager" Bukan Pengangguran',
                    'isi' => 'Jika Anda tidak sekolah, tidak kerja, dan TIDAK MENCARI KERJA (pasrah), BPS mencatat Anda sebagai "Bukan Angkatan Kerja", bukan Pengangguran. Pengangguran Terbuka hanya untuk yang SEDANG MENCARI kerja.'
                ],
                [
                    'judul' => 'Ukuran Kesejahteraan Petani (NTP)',
                    'isi' => 'NTP > 100 artinya Petani Untung. NTP < 100 artinya Petani Rugi/Tekor (biaya pupuk > harga jual panen).'
                ]
            ]
        ],
        'teknologi_validasi' => [
            'label' => '📂 Teknologi & Validasi (Anti Hoax)',
            'items' => [
                [
                    'judul' => 'Data Tidak Langsung "Telan"',
                    'isi' => 'Ada Validasi Logika. Jika responden jawab "Umur 5 tahun status Menikah", sistem akan ERROR dan menolak. Data yang rilis sudah melalui saringan logika ketat.'
                ],
                [
                    'judul' => 'Peta Digital (Wilkerstat)',
                    'isi' => 'Setiap jengkal tanah ditandai GPS. Tidak ada area yang jadi "Anak Tiri" (tak terdata) atau "Anak Emas" (tumpang tindih). Semua ada kapling tugasnya.'
                ]
            ]
        ],
        'indikator_unik' => [
            'label' => '📂 Indikator Unik BPS',
            'items' => [
                [
                    'judul' => 'Indeks Kebahagiaan',
                    'isi' => 'BPS mengukur harmoni keluarga dan kepuasan hidup. Uang banyak (PDRB tinggi) belum tentu paling bahagia. Orang desa seringkali lebih bahagia skornya daripada orang kota macet.'
                ],
                [
                    'judul' => 'Rata-Rata Lama Sekolah (RLS)',
                    'isi' => 'Rapor pendidikan daerah. Jika RLS = 8.5 tahun, artinya rata-rata penduduk cuma tamat SMP kelas 2. Indikator penting buat Bupati bangun sekolah.'
                ]
            ]
        ],
        'tips_warga' => [
            'label' => '📂 Tips Warga Cerdas Data',
            'items' => [
                [
                    'judul' => 'Kapan Waktu Terbaik Didata?',
                    'isi' => 'Jangan tolak petugas, tapi Tawarkan Opsi Waktu (misal: "Bisa datang Sabtu pagi?"). Kepastian waktu sangat membantu petugas.'
                ],
                [
                    'judul' => 'Jangan "Mark-Up" Jawaban',
                    'isi' => 'Jujurlah soal penghasilan. Jika dilebih-lebihkan, kampung Anda dianggap mandiri dan bantuan pemerintah bisa dialihkan ke tempat lain. Jujur menyelamatkan rezeki sekampung!'
                ]
            ]
        ],
        'pariwisata_gaya_hidup' => [
            'label' => '📂 Pariwisata & Gaya Hidup',
            'items' => [
                [
                    'judul' => 'Tingkat Penghunian Kamar (TPK)',
                    'isi' => 'Hotel terisi 60% artinya dari 100 kamar, 60 terjual tiap malam. Di kota non-wisata, ini menandakan Aktivitas Bisnis/Investor yang datang.'
                ],
                [
                    'judul' => 'Lama Tamu Menginap',
                    'isi' => 'Jika rata-rata 1.2 hari = cuma numpang tidur. Jika 3-4 hari = jalan-jalan & belanja. Pemda ngejar >3 hari agar ekonomi lokal bergerak.'
                ]
            ]
        ],
        'mitra_statistik' => [
            'label' => '📂 Pasukan Khusus BPS (Mitra)',
            'items' => [
                [
                    'judul' => 'Siapa Mitra Statistik?',
                    'isi' => 'Warga lokal yang direkrut & dilatih per proyek. Bukan PNS. Mereka adalah Ujung Tombak pendataan.'
                ],
                [
                    'judul' => 'Seleksi Ketat',
                    'isi' => 'Sekarang ada tes via app Sobat BPS (Matematika, Logika, Kepribadian). Petugas yang datang ke rumah Anda adalah orang terpilih yang lolos seleksi.'
                ]
            ]
        ],
        'rapor_pemimpin' => [
            'label' => '📂 Rapor Pemimpin Daerah (IPM)',
            'items' => [
                [
                    'judul' => '"IPK"-nya Bupati/Walikota',
                    'isi' => 'IPM disusun dari 3 pilar: Kesehatan (Umur), Pendidikan (Sekolah), dan Ekonomi (Pengeluaran). Wajib naik tiap tahun!'
                ],
                [
                    'judul' => 'HLS vs RLS',
                    'isi' => 'RLS (Rata-rata): Kondisi sekarang (orang tua). HLS (Harapan): Peluang generasi anak-anak sekolah sampai level apa (misal Kuliah).'
                ]
            ]
        ],
        'gender_sosial' => [
            'label' => '📂 Gender & Sosial',
            'items' => [
                [
                    'judul' => 'Wanita Lebih Panjang Umur',
                    'isi' => 'Statistik dunia: Wanita hidup sampai 73-74th, Pria 69-70th. Pria lebih rentan penyakit jantung & rokok.'
                ],
                [
                    'judul' => 'Rasio Jenis Kelamin',
                    'isi' => 'Angka 105 artinya: Ada 105 Laki-laki untuk setiap 100 Perempuan. >100 = Surplus Cowok. <100 = Surplus Cewek.'
                ]
            ]
        ],
        'perdagangan' => [
            'label' => '📂 Perdagangan',
            'items' => [
                [
                    'judul' => 'Surplus vs Defisit',
                    'isi' => 'Surplus = Jualan (Ekspor) > Belanja (Impor). Defisit = Kebanyakan jajan dari luar negeri.'
                ],
                [
                    'judul' => 'Ekspor Terbesar Kita',
                    'isi' => 'Sawit (CPO) dan Batu Bara. Kalau harga 2 barang ini anjlok, ekonomi RI ikut demam.'
                ]
            ]
        ],
        'jadwal_rilis' => [
            'label' => '📂 Jadwal Rilis Data',
            'items' => [
                [
                    'judul' => '"Lebaran Data" Awal Bulan',
                    'isi' => 'Setiap Tanggal 1 (atau hari kerja pertama) jam 11.00/12.00, BPS Live Streaming rilis Inflasi, Ekspor-Impor, & Wisata. Ditunggu pebisnis se-Indonesia.'
                ]
            ]
        ],
        'rumah_tangga' => [
            'label' => '📂 Istilah Rumah Tangga (Bikin Bingung)',
            'items' => [
                [
                    'judul' => 'Beda Keluarga vs Rumah Tangga',
                    'isi' => 'Keluarga = Hubungan darah/KK. Rumah Tangga = "Satu Dapur/Makan Bareng". Jika adik kakak tinggal serumah tapi masak & belanja sendiri-sendiri, itu 2 Rumah Tangga. Ini konsep ekonomi konsumsi.'
                ],
                [
                    'judul' => 'Kepala Rumah Tangga (KRT)',
                    'isi' => 'Tidak harus Suami. KRT adalah Penanggung Jawab Kebutuhan Sehari-hari. Bisa Istri (jika Suami sakit) atau Anak (jika menanggung orang tua).'
                ]
            ]
        ],
        'konstruksi' => [
            'label' => '📂 Dunia Konstruksi',
            'items' => [
                [
                    'judul' => 'Kenapa Proyek Mahal? (IKK)',
                    'isi' => 'Indeks Kemahalan Konstruksi (IKK) mengukur harga material & upah antar daerah. Bangun jembatan di Papua lebih mahal dari Jawa karena IKK-nya tinggi.'
                ],
                [
                    'judul' => 'Syarat Rumah Layak Huni',
                    'isi' => 'Minimal 7.2 m2 per orang, Atap/Lantai/Dinding kuat (bukan tanah/rumbia), dan ada Akses Air Minum + Sanitasi (WC).'
                ]
            ]
        ],
        'kejahatan' => [
            'label' => '📂 Kejahatan & Keamanan',
            'items' => [
                [
                    'judul' => 'Crime Total vs Dark Number',
                    'isi' => 'Crime Total = Laporan Polisi. Tapi banyak "Dark Number" (kejahatan tak lapor). BPS survei warga langsung untuk tahu angka aslinya.'
                ]
            ]
        ],
        'ketenagakerjaan' => [
            'label' => '📂 Ketenagakerjaan',
            'items' => [
                [
                    'judul' => 'Beban Ketergantungan (Dependency Ratio)',
                    'isi' => 'Angka 45 artinya: 100 pekerja menanggung 45 orang (lansia/anak). Makin kecil makin baik/ringan beban ekonominya.'
                ],
                [
                    'judul' => 'Formal vs Informal',
                    'isi' => 'Formal = Kontrak/BPJS/Gaji Tetap. Informal = Serabutan/Usaha Sendiri/Bantu Ortu. Mayoritas kita di Informal (rentan saat krisis).'
                ]
            ]
        ],
        'layanan_microdata' => [
            'label' => '📂 Layanan "Sultan" (Microdata)',
            'items' => [
                [
                    'judul' => 'Buat Mahasiswa/Peneliti',
                    'isi' => 'Butuh data mentah (raw data) untuk olah sendiri? Minta Layanan Microdata di PST BPS. Bisa cari korelasi spesifik yang gak ada di tabel umum.'
                ]
            ]
        ],
        'pertanian_lahan' => [
            'label' => '📂 Pertanian & Lahan',
            'items' => [
                [
                    'judul' => 'Isu Luas Lahan Baku Sawah',
                    'isi' => 'Sering beda data dengan Dinas. BPS pakai Satelit (KSA). Kalau sawah sudah jadi ruko/perumahan, BPS coret dari luas sawah. Jujur itu pahit.'
                ]
            ]
        ],
        'lowongan_karir' => [
            'label' => '📂 Info Lowongan & Karir',
            'items' => [
                [
                    'judul' => 'Cara Jadi Mitra Statistik',
                    'isi' => 'Daftar di aplikasi/web SOBAT BPS (mitra.bps.go.id). Buat akun, upload KTP/Ijazah, dan tunggu info seleksi di menu "Daftar Survei". Jangan titip berkas fisik!'
                ],
                [
                    'judul' => 'Beda Mitra vs PPPK/CPNS',
                    'isi' => 'Mitra = Pegawai Kontrak per kegiatan (Gaji per gawean). PPPK & CPNS = ASN Tetap (Seleksi terpusat Nasional).'
                ]
            ]
        ],
        'jam_layanan' => [
            'label' => '📂 Jam Layanan Operasional (PST)',
            'items' => [
                [
                    'judul' => 'Jam Buka Kantor',
                    'isi' => 'Senin-Kamis (08.00-15.30), Jumat (08.00-16.00). Sabtu/Minggu Libur. Layanan Online WhatsApp tetap bisa diakses (respon bot).'
                ],
                [
                    'judul' => 'Alamat BPS Batang Hari',
                    'isi' => 'Jl. Jenderal Sudirman, Muara Bulian (Kompleks Perkantoran Pemda, dekat Kantor Bupati/DPRD).'
                ]
            ]
        ],
        'solusi_masalah' => [
            'label' => '📂 Solusi Masalah Website (Tech Support)',
            'items' => [
                [
                    'judul' => 'Web Sobat BPS Error/Lemot',
                    'isi' => 'Biasanya traffic tinggi saat rekrutmen. Solusi: Akses jam sepi (tengah malam), pakai Chrome terbaru, bersihkan cache.'
                ],
                [
                    'judul' => 'Lupa Password Sobat',
                    'isi' => 'Klik "Lupa Password" di mitra.bps.go.id. Link reset masuk email (cek folder Spam).'
                ]
            ]
        ],
        'profil_wilayah' => [
            'label' => '📂 Profil Wilayah Batang Hari',
            'items' => [
                [
                    'judul' => '8 Kecamatan Batang Hari',
                    'isi' => 'Mersam, Maro Sebo Ulu, Batin XXIV, Muara Tembesi, Muara Bulian (Ibukota), Bajubang, Maro Sebo Ilir, Pemayung.'
                ],
                [
                    'judul' => 'Sungai Batanghari',
                    'isi' => 'Sungai terpanjang di Sumatera. Dulu "Jalan Tol" perdagangan nenek moyang, sekarang sumber pengairan vital.'
                ]
            ]
        ],
        'fitur_interaktif' => [
            'label' => '📂 Fun Quiz (Tes Pengetahuan)',
            'items' => [
                [
                    'judul' => 'Tebak Singkatan: PDRB?',
                    'isi' => 'Jataban: Produk Domestik Regional Bruto (Kue Ekonomi Daerah).'
                ],
                [
                    'judul' => 'Mitos/Fakta: Petugas BPS cairkan Bansos?',
                    'isi' => 'MITOS! BPS cuma mendata. Bansos itu wewenang Kemensos.'
                ]
            ]
        ],
        'etika_pengaduan' => [
            'label' => '📂 Etika & Pengaduan',
            'items' => [
                [
                    'judul' => 'Lapor Pungli (Gratifikasi)',
                    'isi' => 'Layanan BPS GRATIS. Petugas dilarang terima uang rokok/imbalan. Jika dipaksa, Lapor ke Pengaduan Masyarakat dengan nama & bukti.'
                ]
            ]
        ]
    ]
];
