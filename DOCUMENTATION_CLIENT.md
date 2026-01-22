# Dokumentasi Pengembangan Aplikasi E-Arsip Surat Kantor

Dokumen ini disusun untuk memberikan informasi teknis dan administratif mengenai pembuatan aplikasi **E-Arsip Surat Kantor**.

## 1. Lingkungan Pengembangan (Technology Stack)

Aplikasi ini dibangun menggunakan teknologi modern yang stabil dan efisien:

- **Framework Backend**: Laravel 10 (PHP Framework)
- **Framework Frontend**: Blade Templating dengan Bootstrap 5
- **Database**: MySQL
- **Library Ekspor**: Maatwebsite Excel (v3.1)
- **Server**: XAMPP (Apache & MySQL)

## 2. Struktur Data (Database Architecture)

Aplikasi mengelola tiga komponen utama yang saling berelasi:

1.  **Klasifikasi**: Untuk kategori surat (Contoh: UND - Undangan Rapat).
2.  **Departemen**: Bagian/Divisi pengirim atau tujuan surat (Contoh: Sekretariat).
3.  **Surat (Letters)**: Inti dari aplikasi yang menyimpan detail nomor surat, subjek, tanggal, sifat (urgensi), dan file PDF.

## 3. Fitur Utama

- **Single Page Interface (SPI)**: Pengguna dapat menambah, mengedit, dan melihat daftar surat dalam satu halaman tanpa perlu berpindah-pindah.
- **Manajemen File**: Mendukung unggahan dokumen dalam format PDF secara aman ke direktori penyimpanan server.
- **Sistem Urgensi Bermodal Warna**: Penggunaan lencana (badge) warna untuk membedakan sifat surat (Biasa, Penting, Rahasia).
- **Rekapitulasi**: Fitur ekspor seluruh data arsip ke dalam format Microsoft Excel (.xlsx) untuk kebutuhan pelaporan.

## 4. Proses Pembuatan (Development Process)

Pembuatan aplikasi ini melalui beberapa tahap sistematis:

### Tahap 1: Analisis Kebutuhan

Identifikasi field database yang diperlukan (nomor surat, klasifikasi, departemen, dll) serta alur kerja user (input data -> simpan file -> lihat arsip).

### Tahap 2: Perancangan Database (Migration)

Penyusunan tabel menggunakan fitur _Migration_ Laravel untuk memastikan struktur database yang konsisten dan memiliki relasi _Foreign Key_ yang kuat antara surat, klasifikasi, dan departemen.

### Tahap 3: Implementasi Logika (Controller & Model)

- Pengaturan relasi antar model (Eloquent ORM).
- Pembuatan logika CRUD (Create, Read, Update, Delete) pada `LettersController`.
- Implementasi validasi data yang ketat (misal: nomor surat harus unik, file harus PDF).

### Tahap 4: Desain Antarmuka (UI/UX)

Pengembangan tampilan menggunakan Bootstrap 5 dengan fokus pada kemudahan penggunaan (_User-Friendly_). Kami menggunakan teknik modal/form dinamis agar proses edit data terasa cepat.

### Tahap 5: Integrasi Fitur Tambahan

Penyusunan sistem ekspor Excel dan pengaturan tautan simbolik (_Symbolic Link_) agar file PDF yang diunggah dapat diakses/dilihat oleh browser secara langsung.

---
