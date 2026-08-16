# PROJECT DOKUMENTASI
# Sistem Informasi Anugrah Jaya Digital Printing
**Framework:** CodeIgniter 4.7 | **Database:** MySQL | **PHP:** ^8.2

---

## INFORMASI PROJECT

| Item | Detail |
|---|---|
| Nama Sistem | Sistem Informasi Anugrah Jaya Digital Printing |
| Framework | CodeIgniter 4.7 |
| Database | MySQL (digital_printing) |
| PHP Version | ^8.2 |
| Editor | Visual Studio Code |
| Web Server | Laragon (localhost) |
| Path Project | c:\laragon\www\ci4 |

---

## AKTOR SISTEM

| No | Aktor | Hak Akses |
|---|---|---|
| 1 | Admin | Kelola semua data: layanan, bahan, pesanan, pelanggan, konfirmasi pembayaran, laporan |
| 2 | Pelanggan | Lihat layanan, pemesanan, upload bukti bayar, pantau status pesanan |
| 3 | Pimpinan | Lihat dan cetak semua laporan |

---

## MODUL SISTEM

| No | Modul | Aktor | Status |
|---|---|---|---|
| 1 | Login & Logout | Admin, Pelanggan, Pimpinan | Controller Selesai |
| 2 | Registrasi | Pelanggan | Controller Selesai |
| 3 | Data Layanan | Admin | Controller Selesai |
| 4 | Data Bahan/Material | Admin | Controller Selesai |
| 5 | Data Pelanggan | Admin | Controller Selesai |
| 6 | Pemesanan | Admin, Pelanggan | Controller Selesai |
| 7 | Konfirmasi Pembayaran | Admin, Pelanggan | Controller Selesai |
| 8 | Status Pesanan | Admin, Pelanggan | Controller Selesai |
| 9 | Laporan | Admin, Pimpinan | Controller Selesai |

---

## STRUKTUR DATABASE

**Nama Database:** `digital_printing`

### Tabel: users
| Field | Type | Ukuran | Keterangan |
|---|---|---|---|
| id_user | Int | 11 | PK, auto increment |
| username | Varchar | 50 | Username login |
| password | Varchar | 255 | Password terenkripsi |
| nama_lengkap | Varchar | 100 | Nama lengkap |
| email | Varchar | 100 | Email pengguna |
| no_hp | Varchar | 15 | Nomor telepon |
| level | Enum | - | admin / pelanggan / pimpinan |
| created_at | Timestamp | - | Waktu buat akun |

### Tabel: kategori
| Field | Type | Ukuran | Keterangan |
|---|---|---|---|
| id_kategori | Int | 11 | PK, auto increment |
| nama_kategori | Varchar | 100 | Nama kategori layanan |
| deskripsi | Text | - | Keterangan kategori |

### Tabel: layanan
| Field | Type | Ukuran | Keterangan |
|---|---|---|---|
| kode_layanan | Char | 10 | PK, kode unik layanan |
| nama_layanan | Varchar | 100 | Nama layanan |
| id_kategori | Int | 11 | FK ke tabel kategori |
| id_bahan | Int | 11 | FK ke tabel bahan |
| harga_satuan | Double | - | Harga per satuan |
| deskripsi | Text | - | Keterangan layanan |
| gambar | Varchar | 200 | Path file gambar |
| status | Enum | - | aktif / nonaktif |

### Tabel: bahan
| Field | Type | Ukuran | Keterangan |
|---|---|---|---|
| id_bahan | Int | 11 | PK, auto increment |
| nama_bahan | Varchar | 100 | Nama bahan/material |
| satuan | Varchar | 20 | Satuan (meter, lembar, dll) |
| stok | Int | 11 | Jumlah stok tersedia |
| stok_minimum | Int | 11 | Batas minimum stok |
| keterangan | Text | - | Keterangan tambahan |

### Tabel: pelanggan
| Field | Type | Ukuran | Keterangan |
|---|---|---|---|
| id_pelanggan | Int | 11 | PK, auto increment |
| id_user | Int | 11 | FK ke tabel users |
| nama_pelanggan | Varchar | 100 | Nama lengkap pelanggan |
| alamat | Text | - | Alamat lengkap |
| no_hp | Varchar | 15 | Nomor telepon |
| email | Varchar | 100 | Email pelanggan |
| created_at | Timestamp | - | Waktu daftar |

### Tabel: pesanan
| Field | Type | Ukuran | Keterangan |
|---|---|---|---|
| no_pesanan | Char | 20 | PK, nomor unik pesanan |
| id_pelanggan | Int | 11 | FK ke tabel pelanggan |
| tgl_pesanan | Date | - | Tanggal pesanan |
| tgl_selesai | Date | - | Estimasi selesai |
| total_harga | Double | - | Total harga pesanan |
| status_pesanan | Varchar | 30 | menunggu/diproses/selesai/dibatalkan |
| status_bayar | Varchar | 20 | belum bayar / sudah bayar |
| catatan | Text | - | Catatan pelanggan |
| created_at | Timestamp | - | Waktu buat record |

### Tabel: detail_pesanan
| Field | Type | Ukuran | Keterangan |
|---|---|---|---|
| id_detail | Bigint | 20 | PK, auto increment |
| no_pesanan | Char | 20 | FK ke tabel pesanan |
| kode_layanan | Char | 10 | FK ke tabel layanan |
| qty | Int | 11 | Jumlah dipesan |
| harga_satuan | Double | - | Harga saat transaksi |
| subtotal | Double | - | qty x harga_satuan |
| ukuran | Varchar | 50 | Ukuran cetak |
| keterangan | Text | - | Keterangan detail |

### Tabel: pembayaran
| Field | Type | Ukuran | Keterangan |
|---|---|---|---|
| id_pembayaran | Int | 11 | PK, auto increment |
| no_pesanan | Char | 20 | FK ke tabel pesanan |
| tgl_pembayaran | Date | - | Tanggal konfirmasi |
| jumlah_bayar | Double | - | Nominal dibayarkan |
| metode_bayar | Varchar | 50 | transfer / tunai |
| bukti_pembayaran | Varchar | 200 | Path file bukti |
| status_konfirmasi | Enum | - | menunggu/diterima/ditolak |
| catatan_admin | Text | - | Catatan verifikasi admin |

---

## RENCANA STRUKTUR FOLDER PROJECT

```
app/
├── Controllers/
│   ├── BaseController.php
│   ├── Auth/
│   │   └── AuthController.php        (login, logout, registrasi)
│   ├── Admin/
│   │   ├── DashboardController.php
│   │   ├── LayananController.php
│   │   ├── BahanController.php
│   │   ├── PelangganController.php
│   │   ├── PesananController.php
│   │   ├── PembayaranController.php
│   │   └── LaporanController.php
│   └── Pelanggan/
│       ├── DashboardController.php
│       ├── PesananController.php
│       ├── PembayaranController.php
│       └── StatusController.php
├── Models/
│   ├── UserModel.php
│   ├── KategoriModel.php
│   ├── LayananModel.php
│   ├── BahanModel.php
│   ├── PelangganModel.php
│   ├── PesananModel.php
│   ├── DetailPesananModel.php
│   └── PembayaranModel.php
├── Views/
│   ├── auth/
│   │   ├── login.php
│   │   └── register.php
│   ├── admin/
│   │   ├── dashboard/
│   │   ├── layanan/
│   │   ├── bahan/
│   │   ├── pelanggan/
│   │   ├── pesanan/
│   │   ├── pembayaran/
│   │   └── laporan/
│   ├── pelanggan/
│   │   ├── dashboard/
│   │   ├── pesanan/
│   │   ├── pembayaran/
│   │   └── status/
│   └── layouts/
│       ├── admin_layout.php
│       └── pelanggan_layout.php
├── Filters/
│   ├── AuthFilter.php
│   ├── AdminFilter.php
│   └── PelangganFilter.php
└── Database/
    ├── Migrations/
    │   ├── 2024-01-01-000001_CreateUsersTable.php
    │   ├── 2024-01-01-000002_CreateKategoriTable.php
    │   ├── 2024-01-01-000003_CreateBahanTable.php
    │   ├── 2024-01-01-000004_CreateLayananTable.php
    │   ├── 2024-01-01-000005_CreatePelangganTable.php
    │   ├── 2024-01-01-000006_CreatePesananTable.php
    │   ├── 2024-01-01-000007_CreateDetailPesananTable.php
    │   └── 2024-01-01-000008_CreatePembayaranTable.php
    └── Seeds/
        └── UserSeeder.php
```

---

## LOG PROGRES PENGERJAAN

### [2026-05-24] - INISIALISASI PROJECT
- Project CI4 fresh install sudah tersedia
- File `project.md` dibuat sebagai dokumentasi utama
- Analisa BAB IV selesai dibaca dan didokumentasikan
- Struktur database dirancang sesuai BAB IV
- Rencana struktur folder sudah ditetapkan
- Status: Selesai

### [2026-05-24] - DATABASE, MODELS, CONTROLLERS, FILTERS
- Dibuat 8 Migration: users, kategori, bahan, layanan, pelanggan, pesanan, detail_pesanan, pembayaran
- Dibuat Seeds: UserSeeder, KategoriSeeder, DatabaseSeeder
- Dibuat 8 Model: UserModel, KategoriModel, BahanModel, LayananModel, PelangganModel, PesananModel, DetailPesananModel, PembayaranModel
- Dibuat Controllers Auth: AuthController (login, register, logout)
- Dibuat Controllers Admin: Dashboard, Layanan, Bahan, Pelanggan, Pesanan, Pembayaran, Laporan
- Dibuat Controllers Pelanggan: Dashboard, Pesanan, Pembayaran, Status
- Dibuat 3 Filter: AuthFilter, AdminFilter, PelangganFilter
- Update Routes.php dengan semua route lengkap + filter
- Update Filters.php daftarkan 3 filter custom
- Update BaseController dengan helpers url, form, text
- Dibuat folder public/uploads/layanan dan public/uploads/pembayaran
- Status: Selesai - Siap lanjut ke Views
- Dibuat partials admin: sidebar, navbar, footer
- Dibuat layout pelanggan: `app/Views/layouts/pelanggan_layout.php`
- Dibuat partials pelanggan: navbar, footer
- Dibuat layout landing page: `app/Views/layouts/landing_layout.php`
- Dibuat partials landing: navbar, footer
- Dibuat halaman landing page: `app/Views/landing/index.php`
- Dibuat CSS: `public/assets/css/admin.css`, `landing.css`, `pelanggan.css`
- Dibuat JS: `public/assets/js/admin.js`, `landing.js`, `pelanggan.js`
- Update `app/Controllers/Home.php` mengarah ke landing page
- Status: Selesai - Siap lanjut ke Migrations & Auth

---

### [2026-05-25] - FIX KONFIGURASI LARAGON & ROUTING
- Diagnosa: Laragon sudah buat virtual host `ci4.test` → DocumentRoot langsung ke `public/`
- Fix `app.baseURL` di `.env` → `http://ci4.test/`
- Fix `$baseURL` di `app/Config/App.php` → `http://ci4.test/`
- Hapus `RewriteBase /ci4/public/` dari `public/.htaccess` (tidak diperlukan karena virtual host)
- Update landing page — layanan dinamis dari DB, tombol aksi sesuai status login
- Update landing navbar — tampilkan Dashboard/Logout jika sudah login
- Update Home controller — pass data layanan aktif ke landing page
- Status: Selesai

- Semua code TIDAK menggunakan komentar dengan simbol `#`
- Setiap modul dipisah ke file dan folder masing-masing
- File ini wajib diupdate setiap ada progres pengerjaan
- Selalu tanya context 7 sebelum pengerjaan tiap sesi

### [2026-05-25] - SEEDER BAHAN DAN LAYANAN
- Dibuat `BahanSeeder.php` — 16 bahan/material sesuai kebutuhan percetakan
- Dibuat `LayananSeeder.php` — 22 layanan sesuai kartu nama Anugrah Jaya Digital Printing
- Update `DatabaseSeeder.php` — urutan: User → Kategori → Bahan → Layanan
- Seeder berhasil dijalankan ke database `dbprinting`
- Status: Selesai

### [2026-05-25] - LOGIKA BISNIS & OTOMASI
- Dibuat `app/Services/StokService.php` — service untuk kurangi/kembalikan stok dari pesanan
- Update `BahanModel` — tambah method `kurangiStok()` dan `tambahStok()` yang lebih eksplisit
- Update `Admin/PesananController` — stok berkurang otomatis saat status diubah ke "diproses", stok kembali saat "dibatalkan"
- Update `Admin/PembayaranController` — stok berkurang otomatis saat konfirmasi pembayaran diterima
- Update `Pelanggan/PesananController` — tanggal pesanan otomatis hari ini, redirect ke form bayar setelah pesan
- Update `Pelanggan/PembayaranController` — tambah daftar rekening (BCA, Mandiri, BRI, Dana, OVO, QRIS, Tunai)
- Update view form pesanan pelanggan — tanggal otomatis, alur pesanan, info rekening
- Update view form pesanan admin — no pesanan & tanggal otomatis, harga satuan tampil, ringkasan total real-time
- Update view detail pesanan admin — info stok, alur status dengan keterangan
- Update view form pembayaran — pilih metode tampilkan rekening masing-masing + QRIS SVG
- StokService: autoload OK via APP_NAMESPACE
- Status: Selesai

### [2026-05-25] - REDESIGN UI/UX 2026
- Redesign `admin.css` — Inter font, gradient sidebar, stat widget dengan gradient, glassmorphism navbar
- Redesign `landing.css` — hero dengan radial glow, floating card, hero badge, section badge, service card hover effect
- Redesign `pelanggan.css` — welcome banner gradient, stat card gradient, Inter font
- Redesign `landing/index.php` — hero floating card preview layanan, hero stat pills, section badge, CTA modern
- Redesign `admin/dashboard/index.php` — stat widget gradient, status bar interaktif, avatar inisial, pulse animation stok
- Redesign `pelanggan/dashboard/index.php` — welcome banner, stat card gradient, layanan dengan icon berwarna
- Update sidebar brand — logo box gradient kuning, brand text + sub text
- Status: Selesai

### [2026-06-02] - FITUR RETURN PESANAN
- Dibuat Migration: `CreateReturnPesananTable` — tabel `return_pesanan`
- Dibuat `ReturnPesananModel.php` — CRUD + query relasi pesanan & pelanggan
- Dibuat `Admin/ReturnController.php` — index, show, prosesReturn (terima/tolak)
- Dibuat `Pelanggan/ReturnController.php` — index, form, store, detail
- Dibuat Views Admin: `admin/return/index.php`, `admin/return/detail.php`
- Dibuat Views Pelanggan: `pelanggan/return/index.php`, `pelanggan/return/form.php`, `pelanggan/return/detail.php`
- Dibuat folder `public/uploads/return`
- Update `Routes.php` — tambah route admin/return dan pelanggan/return
- Update sidebar admin — tambah menu Return Pesanan
- Update navbar pelanggan — tambah menu Return
- Logika: return hanya pesanan selesai, jika diterima status pesanan otomatis dibatalkan
- Migration berhasil dijalankan
- Status: Selesai

### [2026-06-02] - UPDATE LOGIKA BISNIS RETUR PERCETAKAN
- Migration `AlterReturnPesananTable` — tambah kolom jenis_masalah, tipe_revisi, biaya_tambahan
- Update ENUM status_return → menunggu_verifikasi, verifikasi_disetujui, verifikasi_ditolak, proses_cetak_ulang, revisi_desain, selesai
- Update `ReturnPesananModel` — tambah label helper: labelStatus(), labelJenisMasalah(), labelTipeRevisi()
- Update `Admin/ReturnController` — logika proses retur (cetak ulang gratis vs revisi desain berbayar)
- Update `Pelanggan/ReturnController` — form wajib pilih jenis_masalah, status awal menunggu_verifikasi
- Update `badge_status.php` — tambah semua status retur percetakan + support warna purple
- Update view admin/return/index.php — widget 6 status, tabel dengan jenis masalah & biaya
- Update view admin/return/detail.php — form proses dinamis (biaya muncul jika revisi_desain), alur 2 jalur (cetak ulang vs revisi)
- Dibuat view pelanggan/return/detail.php — alur status 2 jalur, info biaya tambahan + tombol WA konfirmasi
- Update view pelanggan/return/form.php — pilihan jenis masalah dengan icon, ketentuan retur
- Status: Selesai

### [2026-06-27] - ERD DATABASE
- Dibuat `diagrams/erd-database.xml` — ERD lengkap 9 tabel dengan notasi Crow's Foot
- Tabel: users, pelanggan, kategori, bahan, layanan, pesanan, detail_pesanan, pembayaran, return_pesanan
- Relasi yang tergambar: 9 relasi (1:1 dan 1:M) dengan label
- PK berwarna orange, FK berwarna biru, header tabel gelap dengan aksen kuning
- Legenda relasi disertakan di bawah diagram
- Status: Selesai

### [2026-07-27] - REVISI BESAR: PEMBELIAN MULTI-ITEM, UPLOAD DESAIN, LOGIKA HARGA
**1. Pembelian Multi-Item + No Faktur:**
- Migration `AddNoFakturToPembelian` — tambah kolom `no_faktur` VARCHAR(20) ke tabel `pembelian`
- Migration `CreateDetailPembelianTable` — tabel `detail_pembelian` (id_detail, id_pembelian, id_bahan, jumlah, harga_satuan, subtotal)
- Dibuat `DetailPembelianModel.php` — CRUD + getByPembelian()
- Update `PembelianModel` — generateNoFaktur() format FB-YYYYMMDD-001, getWithRelasi() subquery total
- Rewrite `Admin/PembelianController` — store() multi-item, stok bertambah per item
- Rewrite view `admin/pembelian/form.php` — form multi-item dinamis + auto no_faktur
- Rewrite view `admin/pembelian/index.php` — tampilkan no_faktur, jumlah item, grand total
- Rewrite view `admin/pembelian/detail.php` — tabel detail items + grand total

**2. Upload Desain di Pemesanan:**
- Migration `AddFileDesainToDetailPesanan` — tambah kolom `file_desain` ke `detail_pesanan`
- Update `Pelanggan/PesananController::store()` — handle file upload ke `public/uploads/desain/`
- Update `Admin/PesananController::store()` — handle file upload juga
- Update view `pelanggan/pesanan/form.php` — input file upload per item
- Update view detail (admin + pelanggan) — tampilkan link download desain

**3. Logika Harga Berdasarkan Tipe:**
- Migration `AddTipeHargaToLayanan` — ENUM tipe_harga (per_meter, per_lembar, per_pcs, per_set, per_huruf, per_buku)
- Update `LayananModel` — tipe_harga ke allowedFields
- Update `LayananSeeder` — 22 layanan dengan tipe_harga yang tepat
- Pricing logic: per_meter = P x L x Harga/m², lainnya = Qty x Harga_satuan
- Update `StokService` — per_meter hitung area, lainnya pakai qty
- Update `Admin/LayananController` — form tipe_harga

**4. Admin Bisa Buat Pesanan:**
- Tambah route admin/pesanan/create + store
- Update `Admin/PesananController` — method create() + store()
- Update admin pesanan form — form lengkap dengan upload desain + pricing dinamis

**5. Folder Baru:** `public/uploads/desain/`
- Status: Selesai — Migration perlu dijalankan: `php spark migrate`
