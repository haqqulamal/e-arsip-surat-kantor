# E-Arsip Surat Kantor

Aplikasi pengarsipan surat kantor sederhana yang dibangun menggunakan Laravel 10 dan Bootstrap 5.

## Fitur Utama
- **Single Page Interface**: Kelola surat dalam satu halaman.
- **Manajemen Surat**: Tambah, Edit, Hapus, dan Lihat PDF surat.
- **Klasifikasi & Departemen**: Pengelompokan surat berdasarkan kategori dan bagian.
- **Ekspor Excel**: Rekap data arsip ke format .xlsx menggunakan `maatwebsite/excel`.

## Cara Menjalankan

### 1. Persiapan Database
- Pastikan MySQL (XAMPP) sudah aktif.
- Buat database baru bernama `db_arsip`.

### 2. Konfigurasi Environment
- Pastikan file `.env` sudah dikonfigurasi:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_arsip
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Instalasi & Setup
Jalankan perintah berikut di terminal:
```bash
# Instal dependencies
composer install

# Jalankan migrasi dan isi data awal (seed)
php artisan migrate --seed

# Buat link storage untuk akses file PDF
php artisan storage:link
```

### 4. Menjalankan Aplikasi
```bash
php artisan serve
```
Akses aplikasi melalui: `http://127.0.0.1:8000/letters`

## FAQ / Troubleshooting

### 1. Error: Export Excel (GD Extension)
Jika muncul error terkait `ext-gd` saat ekspor Excel, Anda perlu mengaktifkan ekstensi GD di PHP:
- Buka **XAMPP Control Panel**.
- Klik tombol **Config** pada baris Apache, pilih **PHP (php.ini)**.
- Cari baris `;extension=gd` (gunakan Ctrl+F).
- Hapus tanda titik koma (`;`) di depannya sehingga menjadi `extension=gd`.
- Simpan file dan **Restart Apache** di XAMPP.

### 2. File PDF tidak muncul (404)
Pastikan sudah menjalankan `php artisan storage:link`. Jika masih error, hapus folder `public/storage` lalu jalankan perintah link kembali.

---

## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

