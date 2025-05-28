# Laravel12 CRUD Sederhana

Panduan ini akan membantu Anda **clone** dan **menjalankan** proyek Laravel "laravel12-crud-sederhana" sehingga web dapat diakses melalui:

- http://laravel12-crud-sederhana.test/products  (menggunakan Valet atau host .test)
- http://127.0.0.1:8000/products           (menggunakan built-in server)

---

## Prasyarat

Sebelum memulai, pastikan Anda telah menginstal:

- **PHP** (versi ≥ 8.0)
- **Composer**
- **Node.js** & **npm**
- **Database** (MySQL, MariaDB, SQLite, dsb.)
- **Laravel Valet** (opsional, untuk domain `.test`)

---

## 1. Clone Repository

```bash
# Ganti URL dengan repository Anda jika berbeda
git clone https://github.com/M-Ardiansyah-EP/laravel12-crud-sederhana.git
cd laravel12-crud-sederhana
```

---

## 2. Install Dependencies

```bash
composer install       # Instal library PHP
data && npm install   # Instal package Node & front-end assets
```

---

## 3. Konfigurasi Environment

1. Duplikat file `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```
2. Buka `.env`, sesuaikan koneksi database (`DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
3. Generate application key:
   ```bash
   php artisan key:generate
   ```

---

## 4. Migrasi Database

```bash
php artisan migrate
# Jika ada seeder, jalankan juga:
# php artisan db:seed
```

---

## 5. Menjalankan Aplikasi

### Opsi A: Built-in Server

```bash
php artisan serve
```
Buka browser dan akses:

```
http://127.0.0.1:8000/products
```

### Opsi B: Laravel Valet (.test)

1. Pastikan Anda berada di folder proyek:
   ```bash
   cd /path/to/laravel12-crud-sederhana
   ```
2. Jalankan:
   ```bash
   valet link laravel12-crud-sederhana
   valet secure laravel12-crud-sederhana   # Opsional: untuk HTTPS
   ```
3. Buka browser dan akses:

```
http://laravel12-crud-sederhana.test/products
```

---

## 6. Tips Tambahan

- Untuk membersihkan cache dan konfigurasi:
  ```bash
  php artisan config:clear
  php artisan cache:clear
  php artisan route:clear
  php artisan view:clear
  ```
- Jika menambahkan front-end assets baru:
  ```bash
  npm run dev         # Development
  npm run build       # Production
  ```

---

Sekarang Anda siap menjelajahi dan mengembangkan proyek Laravel ini! Jika menemukan kendala, cek kembali konfigurasi `.env` dan pastikan database sudah berjalan.
