# Product Management Application

Aplikasi web berbasis Laravel 12 untuk pengelolaan inventaris produk (*Product Management*) yang mencakup operasi *Create, Read, Update,* dan *Delete* (CRUD). Proyek ini disusun sebagai bagian dari *Web Development Technical Test* PT Sumber Trijaya Lestari (Aksesmu).

## Deskripsi Aplikasi

Aplikasi ini menyediakan antarmuka dashboard minimalis untuk mengelola data produk yang meliputi nama produk, deskripsi, harga (dalam format Rupiah), dan jumlah stok. Seluruh proses manipulasi data dilengkapi dengan validasi *server-side*, umpan balik notifikasi (*flash message*), serta paginasi daftar produk.

## Teknologi yang Digunakan

- **Backend Framework:** Laravel 12 (PHP ^8.2)
- **ORM & Database:** Eloquent ORM (mendukung PostgreSQL, MySQL, dan SQLite)
- **Templating Engine:** Laravel Blade
- **Frontend Styling:** Tailwind CSS v4
- **Asset Bundler:** Vite 7

## Fitur Utama

- **Daftar Produk (`GET /products`):** Menampilkan tabel produk dengan penomoran berurutan, format harga Rupiah (`Rp`), indikator status stok (*in stock* / *out of stock*), paginasi, serta tampilan *empty state* jika data belum tersedia.
- **Tambah Produk (`GET /products/create`, `POST /products`):** Formulir penambahan produk baru dengan validasi input di sisi server dan penyimpanan nilai input sebelumnya (`old()`) apabila validasi gagal.
- **Detail Produk (`GET /products/{product}`):** Menampilkan rincian informasi produk beserta waktu pembuatan (`created_at`) dan pembaruan terakhir (`updated_at`).
- **Perbarui Produk (`GET /products/{product}/edit`, `PUT /products/{product}`):** Formulir pembaruan data produk yang sudah tersimpan di database.
- **Hapus Produk (`DELETE /products/{product}`):** Penghapusan data produk yang dilengkapi dialog konfirmasi sebelum permintaan dikirimkan ke server.
- **Database Seeder (`ProductSeeder`):** Penyediaan data awal produk yang bersifat *idempotent* (aman dijalankan berulang kali tanpa menduplikasi data).

## Persyaratan Instalasi

Pastikan perangkat lokal telah terpasang:

- **PHP** >= 8.2 (beserta ekstensi `pdo_pgsql` atau `pdo_mysql`, `mbstring`, `openssl`, `xml`, `ctype`, `json`)
- **Composer** >= 2.x
- **Node.js** >= 18.x dan **NPM**
- **Database Server:** PostgreSQL atau MySQL

## Langkah Instalasi Lokal

1. **Salin repositori dan masuk ke direktori proyek:**

   ```bash
   git clone <repository-url>
   cd aksesmu-web-development-test
   ```

2. **Instal dependensi PHP melalui Composer:**

   ```bash
   composer install
   ```

3. **Salin file konfigurasi environment dan buat *application key*:**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Instal dependensi frontend melalui NPM:**

   ```bash
   npm install
   ```

## Konfigurasi Database

1. Buat database baru pada PostgreSQL atau MySQL (contoh: `aksesmu_test`).
2. Sesuaikan konfigurasi koneksi database pada file `.env`:

   **Contoh untuk PostgreSQL:**
   ```dotenv
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=aksesmu_test
   DB_USERNAME=postgres
   DB_PASSWORD=your_password
   ```

   **Contoh untuk MySQL:**
   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=aksesmu_test
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

3. Jalankan migrasi tabel dan *seeder* data awal produk:

   ```bash
   php artisan migrate
   php artisan db:seed --class=ProductSeeder
   ```

## Informasi Build Frontend

Aplikasi ini menggunakan Vite dan Tailwind CSS v4 untuk kompilasi aset CSS dan JavaScript.

- **Build aset untuk produksi:**

  ```bash
  npm run build
  ```

- **Menjalankan Vite server saat pengembangan (hot reload):**

  ```bash
  npm run dev
  ```

## Cara Menjalankan Aplikasi

1. Pastikan aset frontend telah dibuild (`npm run build`) atau Vite server sedang berjalan (`npm run dev`).
2. Jalankan *development server* Laravel:

   ```bash
   php artisan serve
   ```

3. Buka aplikasi melalui peramban pada alamat:

   ```text
   http://127.0.0.1:8000
   ```

## Pengujian (Testing)

Untuk menjalankan pengujian fitur otomatis menggunakan PHPUnit:

```bash
php artisan test
```
