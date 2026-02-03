# Panduan Kontribusi

Terima kasih atas minat Anda untuk berkontribusi pada Sistem Informasi BPS Batang Hari! 🎉

## 📋 Cara Berkontribusi

### 1. Fork & Clone
```bash
# Fork repository melalui GitHub
# Clone fork Anda
git clone https://github.com/YOUR-USERNAME/blogify-main.git
cd blogify-main

# Tambahkan upstream remote
git remote add upstream https://github.com/sNyum/blogify-main.git
```

### 2. Buat Branch Baru
```bash
# Update main branch
git checkout main
git pull upstream main

# Buat branch fitur
git checkout -b feature/nama-fitur-anda
```

### 3. Lakukan Perubahan
- Tulis kode yang bersih dan mudah dipahami
- Ikuti coding standards Laravel
- Tambahkan komentar untuk logika yang kompleks
- Update dokumentasi jika diperlukan

### 4. Testing
```bash
# Jalankan tests
php artisan test

# Pastikan semua tests pass
```

### 5. Commit
```bash
git add .
git commit -m "feat: deskripsi singkat perubahan"
```

**Format Commit Message:**
- `feat:` - Fitur baru
- `fix:` - Bug fix
- `docs:` - Perubahan dokumentasi
- `style:` - Formatting, missing semi colons, etc
- `refactor:` - Refactoring code
- `test:` - Menambah tests
- `chore:` - Maintenance tasks

### 6. Push & Pull Request
```bash
# Push ke fork Anda
git push origin feature/nama-fitur-anda
```

Kemudian buat Pull Request melalui GitHub dengan:
- Judul yang jelas dan deskriptif
- Deskripsi detail tentang perubahan
- Screenshot jika ada perubahan UI
- Reference ke issue terkait (jika ada)

## 🎯 Area Kontribusi

### Prioritas Tinggi
- 🐛 Bug fixes
- 📝 Perbaikan dokumentasi
- ♿ Peningkatan accessibility
- 🔒 Security improvements

### Ide Kontribusi
- ✨ Fitur baru untuk analisis data
- 🎨 Peningkatan UI/UX
- ⚡ Optimasi performa
- 🌐 Internationalization (i18n)
- 📊 Visualisasi data tambahan
- 🧪 Menambah test coverage

## 📝 Coding Standards

### PHP/Laravel
- Ikuti [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standard
- Gunakan type hints untuk parameter dan return types
- Tulis DocBlocks untuk methods yang kompleks
- Gunakan Laravel best practices

```php
// ✅ Good
public function getUserData(int $userId): array
{
    return User::findOrFail($userId)->toArray();
}

// ❌ Bad
public function getUserData($userId)
{
    return User::find($userId)->toArray();
}
```

### JavaScript
- Gunakan ES6+ syntax
- Prefer `const` dan `let` daripada `var`
- Gunakan arrow functions untuk callbacks
- Format dengan Prettier (jika tersedia)

### Blade Templates
- Gunakan Blade components untuk reusable UI
- Hindari logic kompleks di views
- Gunakan `@auth`, `@guest` directives
- Escape output dengan `{{ }}` bukan `{!! !!}` kecuali diperlukan

### CSS/Tailwind
- Gunakan Tailwind utility classes
- Hindari custom CSS jika memungkinkan
- Gunakan responsive classes (`sm:`, `md:`, `lg:`)
- Kelompokkan classes secara logis

## 🧪 Testing Guidelines

### Unit Tests
```php
public function test_user_can_create_data_request(): void
{
    $user = User::factory()->create();
    
    $response = $this->actingAs($user)
        ->post('/permohonan', [
            'judul' => 'Test Request',
            'deskripsi' => 'Test Description',
        ]);
    
    $response->assertStatus(201);
    $this->assertDatabaseHas('permohonan_data', [
        'judul' => 'Test Request',
    ]);
}
```

### Feature Tests
- Test happy path dan edge cases
- Test authorization dan validation
- Test database transactions
- Mock external API calls

## 🔍 Code Review Process

Pull Request Anda akan direview berdasarkan:
1. ✅ Functionality - Apakah fitur bekerja sesuai harapan?
2. 📖 Code Quality - Apakah kode mudah dibaca dan dipahami?
3. 🧪 Tests - Apakah ada tests yang memadai?
4. 📝 Documentation - Apakah dokumentasi diupdate?
5. 🔒 Security - Apakah ada potensi security issues?
6. ⚡ Performance - Apakah ada dampak performa?

## 🚫 Hal yang Harus Dihindari

- ❌ Commit langsung ke branch `main`
- ❌ Commit credentials atau API keys
- ❌ Commit file `node_modules/` atau `vendor/`
- ❌ Breaking changes tanpa diskusi
- ❌ Code yang tidak di-test
- ❌ Hardcoded values yang seharusnya di config

## 💬 Komunikasi

- 💡 Diskusikan fitur besar di Issues sebelum coding
- 🐛 Laporkan bugs dengan detail reproduksi
- ❓ Tanya di Discussions jika ada pertanyaan
- 📧 Email untuk masalah sensitif

## 📜 License

Dengan berkontribusi, Anda setuju bahwa kontribusi Anda akan dilisensikan di bawah MIT License yang sama dengan proyek ini.

---

**Terima kasih telah berkontribusi! 🙏**
