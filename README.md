# Blogify - Sistem Informasi & Layanan Publik

Platform **Blogify** adalah aplikasi web modern yang dibangun menggunakan **Laravel 12** dan **Filament v4**. Sistem ini tidak hanya berfungsi sebagai admin panel untuk pengelolaan berita, tetapi juga dilengkapi dengan dashboard pengguna, layanan publik, dan **sistem live chat real-time**.

## 🚀 Fitur Utama

### 1. Panel Admin (Filament)
- **Dashboard Analitik**: Statistik ringkas untuk monitoring konten.
- **Manajemen Berita**: CRUD lengkap, upload gambar dengan preview, dan publikasi konten.
- **Manajemen Pustaka/Dokumen**: Upload dan pengelolaan file publik.
- **Manajemen User**: Pengelolaan pengguna dan hak akses.
- **Moderasi Chat**: Memantau dan membalas pesan dari pengguna melalui fitur live chat.

### 2. User Dashboard & Layanan
- **Halaman Depan (Landing Page)**: Desain modern untuk akses publik.
- **Dashboard Pengguna**: Area khusus untuk pengguna terdaftar melihat status layanan.
- **Live Chat Real-time**: Komunikasi langsung antara pengguna dan admin menggunakan **Laravel Reverb**.
- **Fitur AI Chatbot**: Asisten virtual cerdas yang terintegrasi (Gemini API) untuk menjawab pertanyaan umum.
- **Grafik & Visualisasi Data**: Menampilkan data statistik sektoral (Chart.js/ECharts).

### 3. Keamanan & Performa
- Otentikasi aman menggunakan **Sanctum** / Filament Auth.
- Real-time broadcasting dengan WebSocket (Reverb) tanpa ketergantungan layanan pihak ketiga berbayar (seperti Pusher).

---

## 🛠️ Tech Stack

- **Backend**: PHP 8.2+, Laravel 12
- **Admin Panel**: Filament v4
- **Frontend**: Blade, Livewire, Tailwind CSS
- **Real-time**: Laravel Reverb
- **Database**: MySQL / SQLite (Development)
- **AI Integration**: Google Gemini API

---

## ⚙️ Instalasi

Ikuti langkah berikut untuk menjalankan project di lokal:

1. **Clone Repository**
   ```bash
   git clone https://github.com/sNyum/blogify-main.git
   cd blogify-main
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup Environment**
   Salin file konfigurasi dan generate app key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Pastikan konfigurasi database di `.env` sudah sesuai.*

4. **Konfigurasi Database & Migrasi**
   ```bash
   php artisan migrate --seed
   ```
   *(Gunakan `--seed` jika ingin mengisi data awal)*

5. **Setup Storage**
   Agar file upload dapat diakses publik:
   ```bash
   php artisan storage:link
   ```

6. **Jalankan Layanan Real-time (Reverb)**
   Penting untuk fitur chat:
   ```bash
   php artisan reverb:start
   ```

7. **Compile Assets & Jalankan Server**
   Buka terminal baru untuk menjalankan Vite dan server Laravel:
   ```bash
   npm run dev
   php artisan serve
   ```

Akses aplikasi di: `http://localhost:8000`

---

## 📂 Struktur Direktori Penting

- `app/Filament` → Resource, Pages, dan logika Admin Panel.
- `resources/views` → Tampilan frontend (Landing, User Dashboard).
- `routes/channels.php` → Konfigurasi channel broadcasting (Chat).
- `app/Events` → Event untuk broadcasting pesan.
