**Activity Diagram** adalah salah satu diagram dalam **UML (Unified Modeling Language)** yang digunakan untuk **menggambarkan alur kerja (workflow) atau proses bisnis** dari awal hingga akhir dalam suatu sistem. Diagram ini menunjukkan urutan aktivitas yang dilakukan oleh pengguna maupun sistem.

Sederhananya,  **activity diagram seperti flowchart** , tetapi lebih khusus digunakan dalam analisis dan perancangan sistem informasi.

## Fungsi Activity Diagram

* Menggambarkan proses bisnis yang sedang berjalan.
* Menunjukkan urutan aktivitas dalam suatu sistem.
* Memudahkan programmer memahami alur kerja aplikasi.
* Menjadi dokumentasi pada Bab III atau Bab IV skripsi.

## Simbol-Simbol Activity Diagram

| Simbol              | Nama         | Fungsi                                                     |
| ------------------- | ------------ | ---------------------------------------------------------- |
| ●                  | Initial Node | Menandakan awal proses                                     |
| ▭ (sudut membulat) | Activity     | Aktivitas yang dilakukan                                   |
| ◇                  | Decision     | Percabangan (Ya/Tidak)                                     |
| →                  | Control Flow | Aliran proses                                              |
| ◎                  | Final Node   | Menandakan akhir proses                                    |
| ┃                  | Swimlane     | Membagi aktivitas berdasarkan pelaku (Admin, User, Sistem) |

## Contoh Sederhana

Misalnya proses  **Login** .

```text
●
│
Masukkan Username & Password
│
Klik Login
│
◇ Data Valid?
├── Ya ──► Masuk Dashboard
│             │
│             ◎
│
└── Tidak ─► Tampilkan Pesan Error
               │
               ◎
```

## Contoh Activity Diagram Sistem Percetakan

```text
●
│
Pelanggan datang
│
Mengisi data pesanan
│
Admin menerima pesanan
│
Cek desain
│
◇ Desain sesuai?
├── Ya
│      │
│      Cetak
│      │
│      Pembayaran
│      │
│      Serahkan hasil cetak
│      │
│      ◎
│
└── Tidak
       │
       Revisi desain
       │
       Kembali cek desain
```

## Perbedaan Activity Diagram dengan Flowchart

| Flowchart                  | Activity Diagram                         |
| -------------------------- | ---------------------------------------- |
| Digunakan untuk algoritma  | Digunakan untuk proses sistem            |
| Tidak memiliki swimlane    | Dapat menggunakan swimlane               |
| Lebih sederhana            | Lebih lengkap karena bagian dari UML     |
| Fokus pada langkah program | Fokus pada aktivitas pengguna dan sistem |

## Kapan Digunakan?

Activity Diagram biasanya dibuat setelah:

1. Analisis kebutuhan sistem.
2. Penyusunan Use Case Diagram.

Urutan diagram UML yang umum adalah:

1. **Use Case Diagram** → menunjukkan aktor dan fungsi sistem.
2. **Activity Diagram** → menunjukkan alur setiap fungsi.
3. **Sequence Diagram** → menunjukkan interaksi objek secara berurutan.
4. **Class Diagram** → menunjukkan struktur kelas dan relasinya.

Karena Anda sedang mengerjakan  **skripsi Sistem Informasi Percetakan berbasis web** , setiap fitur utama sebaiknya memiliki Activity Diagram sendiri, misalnya:

* Login
* Kelola Data Pelanggan
* Kelola Produk
* Pemesanan
* Pembayaran
* Konfirmasi Pembayaran
* Proses Cetak
* Pengambilan Pesanan
* Laporan Penjualan

Dengan begitu, dokumentasi analisis sistem akan lebih lengkap dan sesuai standar UML untuk skripsi.
