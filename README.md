# Blogify Admin

Admin panel untuk mengelola **Berita** menggunakan **Laravel** dan **Filament v4**.  
Project ini fokus pada sisi **admin (CMS)**, bukan frontend user.

## Fitur
- CRUD Berita
- Upload foto berita
- Preview gambar di tabel
- Sorting berita terbaru
- Dashboard admin (Filament)
- SQLite / MySQL ready

## Tech Stack
- PHP 8.2+
- Laravel
- Filament v4
- SQLite / MySQL
- Tailwind (via Filament)

## Instalasi

Clone repository:
```bash
git clone https://github.com/USERNAME/blogify-admin.git
cd blogify-admin
Install dependency:

bash
Copy code
composer install
npm install
Setup environment:

bash
Copy code
cp .env.example .env
php artisan key:generate
Migrasi database:

bash
Copy code
php artisan migrate
Storage link (WAJIB untuk upload foto):

bash
Copy code
php artisan storage:link
Jalankan server:

bash
Copy code
php artisan serve
Login Admin
Gunakan akun admin yang sudah dibuat (atau buat manual via seeder / tinker).

Struktur Penting
app/Filament → Resource & admin panel

database/migrations → Struktur tabel

storage/app/public → File upload (foto berita)

Catatan
Project ini hanya admin, frontend user belum dibuat

Filament versi 4 (menggunakan API terbaru, bukan v3)

SQLite direkomendasikan untuk development

