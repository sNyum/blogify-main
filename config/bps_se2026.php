<?php

return [
    'title' => 'Sensus Ekonomi 2026 (SE2026)',
    'description' => 'Penjelasan lengkap mengenai Sensus Ekonomi 2026 (SE2026) beserta contoh-contohnya, disusun khusus agar relevan dengan konteks BPS dan pemahaman wilayah seperti Kabupaten Batang Hari.',
    'data' => [
        'definisi' => [
            'judul' => 'Apa Itu Sensus Ekonomi 2026?',
            'isi' => "Sensus Ekonomi 2026 (SE2026) adalah kegiatan pendataan massal yang dilakukan oleh Badan Pusat Statistik (BPS) untuk mendata SELURUH unit usaha/perusahaan yang ada di Indonesia.\n\n" .
                     "- Waktu Pelaksanaan: Dilakukan setiap 10 tahun sekali pada tahun yang berakhiran angka 6 (sebelumnya 2006, 2016, dan kini 2026).\n" .
                     "- Sifat: Wajib dan menyeluruh (mencakup seluruh wilayah NKRI).\n" .
                     "- Kata Kunci Utama: Mendata semua aktivitas ekonomi KECUALI Sektor Pertanian."
        ],
        'tujuan' => [
            'judul' => 'Tujuan Sensus Ekonomi 2026',
            'isi' => "Tujuan utamanya adalah untuk memotret 'wajah' perekonomian Indonesia secara utuh. Data ini digunakan untuk:\n" .
                     "1. Mengetahui struktur ekonomi (berapa banyak UMKM vs perusahaan besar).\n" .
                     "2. Landasan penyusunan kebijakan pemerintah (misalnya bantuan modal usaha, perpajakan, dan penyerapan tenaga kerja).\n" .
                     "3. Mengetahui daya saing bisnis di tingkat global."
        ],
        'cakupan' => [
            'judul' => 'Cakupan: Apa yang Didata dan Tidak Didata?',
            'tidak_didata' => [
                'label' => 'X TIDAK DIDATA di SE2026',
                'items' => [
                    "Sektor Pertanian (Sektor A): Petani padi, petani sawit, nelayan tangkap, peternak sapi. (Alasan: Sudah didata pada Sensus Pertanian 2023/ST2023).",
                    "Instansi Pemerintah: Kantor Camat, Dinas, Kantor Desa (Sektor O)."
                ]
            ],
            'didata' => [
                'label' => '✓ DIDATA di SE2026 (18 Sektor Lainnya)',
                'items' => [
                    "Mencakup Pertambangan, Industri Pengolahan, Listrik, Konstruksi, Perdagangan, Transportasi, Penyediaan Akomodasi, Informasi & Komunikasi, Keuangan, Real Estate, Jasa Pendidikan Swasta, Jasa Kesehatan Swasta, dll."
                ]
            ]
        ],
        'contoh_konkret' => [
            'judul' => 'Contoh Konkret Unit Usaha di SE2026 (Konteks Batang Hari)',
            'kategori' => [
                'mikro_kecil' => [
                    'label' => '1. Usaha Skala Mikro & Kecil (Sering ditemui di pemukiman)',
                    'items' => [
                        "Warung & Toko: Warung kelontong, toko baju di pasar, konter pulsa, agen BRILink.",
                        "Makanan & Minuman: Tukang bakso keliling, warung seblak, catering rumahan, warkop.",
                        "Jasa Perorangan: Tukang pangkas rambut, bengkel motor rumahan, penjahit, laundry kiloan.",
                        "Usaha Online: Reseller online shop (Shopee/Tokopedia) yang beroperasi dari rumah, konten kreator (YouTuber/TikToker) yang memiliki penghasilan."
                    ]
                ],
                'komoditas' => [
                    'label' => '2. Usaha Terkait Komoditas (Penting untuk wilayah Batang Hari)',
                    'items' => [
                        "Toke/Pengepul: Toke sawit atau toke karet (masuk kategori Perdagangan).",
                        "Pengolahan: Pabrik Kelapa Sawit (PKS), pabrik crumb rubber (karet), pabrik tahu/tempe (masuk kategori Industri Pengolahan).",
                        "Transportasi: Jasa angkutan truk sawit, travel antar-kabupaten."
                    ]
                ],
                'menengah_besar' => [
                    'label' => '3. Usaha Skala Menengah & Besar',
                    'items' => [
                        "Keuangan: Kantor cabang Bank (BRI, Mandiri, Bank 9 Jambi), Koperasi Simpan Pinjam, Pegadaian.",
                        "Ritel Modern: Alfamart, Indomaret, Supermarket.",
                        "Lainnya: Hotel, Rumah Sakit Swasta, Kontraktor bangunan (CV/PT)."
                    ]
                ]
            ]
        ],
        'studi_kasus' => [
            'judul' => 'Studi Kasus Perbedaan: Sensus Pertanian vs Sensus Ekonomi',
            'deskripsi' => 'Contoh rantai bisnis Kelapa Sawit:',
            'tabel' => [
                ['Aktivitas' => 'Pak Budi menanam sawit di kebun miliknya', 'Sensus' => 'Sensus Pertanian 2023', 'Alasan' => 'Budidaya tanaman (Sektor A)'],
                ['Aktivitas' => 'Pak Budi menjual sawit ke Toke (Pengepul)', 'Sensus' => 'Sensus Ekonomi 2026', 'Alasan' => 'Aktivitas jual-beli (Perdagangan)'],
                ['Aktivitas' => 'Truk mengangkut sawit ke Pabrik', 'Sensus' => 'Sensus Ekonomi 2026', 'Alasan' => 'Jasa angkutan (Transportasi)'],
                ['Aktivitas' => 'Pabrik mengolah sawit jadi CPO', 'Sensus' => 'Sensus Ekonomi 2026', 'Alasan' => 'Mengubah barang mentah jadi jadi (Industri Pengolahan)'],
            ]
        ],
        'metode' => [
            'judul' => 'Metode Pendataan',
            'isi' => "BPS kemungkinan besar akan menggunakan metode campuran (Hybrid):\n" .
                     "1. CAPI (Computer Assisted Personal Interviewing): Petugas datang mencatat pakai HP/Tablet (untuk usaha kecil/rumah tangga).\n" .
                     "2. CAWI (Computer Assisted Web Interviewing): Perusahaan besar mengisi data sendiri melalui website (Self-enumeration).\n" .
                     "3. Listing: Petugas menyisir dari rumah ke rumah (door-to-door) untuk memastikan tidak ada usaha rumahan yang terlewat."
        ]
    ]
];
