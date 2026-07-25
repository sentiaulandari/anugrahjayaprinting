**Ini adalah aturan project , ikuti perintah yang ada di dalam file ini**

# SELALU TANYA CONTEXT 7 SEBELUM PENGERJAAN

# JANGAN MENAMBAHKAN CODE YANG MENGGUNAKAN # DLL DI DALAM FILE CODE YANG DI BUAT

# PISAHKAN SEMUA CODE DI FILE DAN FOLDER , JANGAN DI TUMPUK DI SATU FILE , BUAT SERAPI MUNGKIN AGAR STRUKTUR JELAS DI MENGERTI

# JANGAN SEMBARANGAN MEMBUAT FILE MD

# KERJAKAN FILE SESUAI DENGAN VERSION TERBARU DAN SELALU TANYA CONTEXT 7



**1)
****Use Case
Narrative Daftar Akun**

**Tabel
4.3 Use Case Narrative Daftar Akun**

| **Nama Use Case :**                                              | Daftar Akun                                                                                      |
| ---------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------ |
| **ID Use Case :**                                                | UC-01                                                                                            |
| **Prioritas :**                                                  | Tinggi                                                                                           |
| **Sumber :**                                                     | -                                                                                                |
| **Pelaku Bisnis Utama :**                                        | Konsumen                                                                                         |
| **Deskripsi :**                                                  | Proses pendaftaran akun baru oleh konsumen dengan                                                |
| mengisi data seperti nama, username, dan password agar dapat mengakses |                                                                                                  |
| sistem.                                                                |                                                                                                  |
| **Prakondisi :**                                                 | Aktor konsumen berada pada halaman login sistem.                                                 |
| **Bidang Khas Suatu Event**                                      | **Kegiatan Pelaku**                                                                        |
| **Daftar Akun**                                                  | 1. Klik menu daftar akun. 3. Mengisi data username, nama lengkap, email, dan                     |
| password lalu menekan tombol simpan.                                   | 2. Sistem menampilkan form registrasi akun. 4. Sistem melakukan validasi data dan menyimpan data |
| ke tabel users.                                                        |                                                                                                  |
| **Bidang Alternatif :**                                          | Jika data yang diinput tidak valid atau tidak lengkap,                                           |
| sistem menampilkan pesan kesalahan dan mengarahkan kembali ke form     |                                                                                                  |
| registrasi.                                                            |                                                                                                  |
| **Kesimpulan :**                                                 | Use case ini menjelaskan bagaimana cara konsumen                                                 |
| melakukan pendaftaran akun baru ke dalam sistem.                       |                                                                                                  |

# 2)

Use Case Narrative Pengelolaan Konsumen

**Tabel
4.4 Use Case Narrative Pengelolaan Konsumen**

| **Nama Use Case :**                                                   | Pengelolaan Konsumen                                                                                                                                |
| --------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------- |
| **ID Use Case :**                                                     | UC-02                                                                                                                                               |
| **Prioritas :**                                                       | Tinggi                                                                                                                                              |
| **Sumber :**                                                          | Tabel konsumen                                                                                                                                      |
| **Pelaku Bisnis Utama :**                                             | Admin                                                                                                                                               |
| **Deskripsi :**                                                       | Proses pengelolaan data konsumen meliputi tambah,                                                                                                   |
| ubah, dan hapus data nama, nomor telepon, dan alamat konsumen.              |                                                                                                                                                     |
| **Prakondisi :**                                                      | Aktor admin telah login ke dalam sistem.                                                                                                            |
| **Bidang Khas Suatu Event**                                           | **Kegiatan Pelaku**                                                                                                                           |
| **Tambah data konsumen**                                              | 1. Klik menu data konsumen. 3. Klik tambah data konsumen. 5. Mengisi nama, nomor telepon, dan alamat lalu                                           |
| menekan tombol simpan.                                                      | 2. Sistem menampilkan daftar data konsumen dalam                                                                                                    |
| bentuk tabel. 4. Sistem menampilkan halaman form input data                 |                                                                                                                                                     |
| konsumen. 6. Sistem memvalidasi dan menyimpan data, lalu menampilkan        |                                                                                                                                                     |
| notifikasi data berhasil disimpan.                                          |                                                                                                                                                     |
| **Ubah data konsumen**                                                | 1. Klik menu data konsumen. 3. Memilih data konsumen yang akan diubah. 5. Melakukan perubahan data lalu menekan tombol                              |
| update.                                                                     | 2. Sistem menampilkan daftar data konsumen. 4. Sistem menampilkan halaman form edit data konsumen. 6. Sistem memvalidasi dan memperbarui data, lalu |
| menampilkan notifikasi data berhasil diubah.                                |                                                                                                                                                     |
| **Hapus data konsumen**                                               | 1. Klik menu data konsumen. 3. Memilih data konsumen yang akan dihapus lalu klik tombol                                                             |
| hapus. 5. Menekan tombol konfirmasi hapus.                                  | 2. Sistem menampilkan daftar data konsumen. 4. Sistem menampilkan konfirmasi penghapusan data. 6. Sistem menghapus data dan menampilkan notifikasi  |
| data berhasil dihapus.                                                      |                                                                                                                                                     |
| **Bidang Alternatif :**                                               | Jika terjadi kesalahan saat validasi input data                                                                                                     |
| tambah, ubah, atau hapus, sistem menampilkan pesan kesalahan dan kembali ke |                                                                                                                                                     |
| halaman sebelumnya.                                                         |                                                                                                                                                     |
| **Kesimpulan :**                                                      | Use case ini menjelaskan bagaimana cara admin                                                                                                       |
| mengelola data konsumen pada sistem.                                        |                                                                                                                                                     |

# 3)

Use Case Narrative Pengelolaan Produk

**Tabel
4.5 Use Case Narrative Pengelolaan Produk**

| **Nama Use Case :**                                                                                   | Pengelolaan Produk                                                                                                                               |
| ----------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------ |
| **ID Use Case :**                                                                                     | UC-03                                                                                                                                            |
| **Prioritas :**                                                                                       | Tinggi                                                                                                                                           |
| **Sumber :**                                                                                          | Tabel produk                                                                                                                                     |
| **Pelaku Bisnis Utama :**                                                                             | Admin                                                                                                                                            |
| **Deskripsi :**                                                                                       | Proses pengelolaan data produk cetak beserta harga per                                                                                           |
| satuan dan spesifikasi produk.                                                                              |                                                                                                                                                  |
| **Prakondisi :**                                                                                      | Aktor admin telah login ke dalam sistem.                                                                                                         |
| **Bidang Khas Suatu Event**                                                                           | **Kegiatan Pelaku**                                                                                                                        |
| **Tambah data produk**                                                                                | 1. Klik menu data produk. 3. Klik tambah data produk. 5. Mengisi nama produk, harga per satuan, dan                                              |
| deskripsi produk, lalu menekan tombol simpan.                                                               | 2. Sistem menampilkan daftar data produk dalam bentuk                                                                                            |
| tabel. 4. Sistem menampilkan halaman form input data produk. 6. Sistem memvalidasi dan menyimpan data, lalu |                                                                                                                                                  |
| menampilkan notifikasi data berhasil disimpan.                                                              |                                                                                                                                                  |
| **Ubah data produk**                                                                                  | 1. Klik menu data produk. 3. Memilih data produk yang akan diubah. 5. Melakukan perubahan data lalu menekan tombol                               |
| update.                                                                                                     | 2. Sistem menampilkan daftar data produk. 4. Sistem menampilkan halaman form edit data produk. 6. Sistem memvalidasi dan memperbarui data, lalu  |
| menampilkan notifikasi data berhasil diubah.                                                                |                                                                                                                                                  |
| **Hapus data produk**                                                                                 | 1. Klik menu data produk. 3. Memilih data produk yang akan dihapus lalu klik                                                                     |
| tombol hapus. 5. Menekan tombol konfirmasi hapus.                                                           | 2. Sistem menampilkan daftar data produk. 4. Sistem menampilkan konfirmasi penghapusan data. 6. Sistem menghapus data dan menampilkan notifikasi |
| data berhasil dihapus.                                                                                      |                                                                                                                                                  |
| **Bidang Alternatif :**                                                                               | Jika data harga produk tidak diisi dengan benar,                                                                                                 |
| sistem menampilkan pesan kesalahan dan tidak menyimpan data.                                                |                                                                                                                                                  |
| **Kesimpulan :**                                                                                      | Use case ini menjelaskan bagaimana cara admin                                                                                                    |
| mengelola data produk cetak beserta harganya.                                                               |                                                                                                                                                  |

# 4)

Use Case Narrative Pengelolaan Supplier

**Tabel
4.6 Use Case Narrative Pengelolaan Supplier**

| **Nama Use Case :**                                                  | Pengelolaan Supplier                                                                                                                                |
| -------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------- |
| **ID Use Case :**                                                    | UC-04                                                                                                                                               |
| **Prioritas :**                                                      | Tinggi                                                                                                                                              |
| **Sumber :**                                                         | Tabel supplier                                                                                                                                      |
| **Pelaku Bisnis Utama :**                                            | Admin                                                                                                                                               |
| **Deskripsi :**                                                      | Proses pengelolaan data supplier meliputi tambah,                                                                                                   |
| ubah, dan hapus data nama, kontak, dan alamat supplier.                    |                                                                                                                                                     |
| **Prakondisi :**                                                     | Aktor admin telah login ke dalam sistem.                                                                                                            |
| **Bidang Khas Suatu Event**                                          | **Kegiatan Pelaku**                                                                                                                           |
| **Tambah data supplier**                                             | 1. Klik menu data supplier. 3. Klik tambah data supplier. 5. Mengisi nama, alamat, dan nomor telepon supplier,                                      |
| lalu menekan tombol simpan.                                                | 2. Sistem menampilkan daftar data supplier dalam                                                                                                    |
| bentuk tabel. 4. Sistem menampilkan halaman form input data                |                                                                                                                                                     |
| supplier. 6. Sistem memvalidasi dan menyimpan data, lalu                   |                                                                                                                                                     |
| menampilkan notifikasi data berhasil disimpan.                             |                                                                                                                                                     |
| **Ubah data supplier**                                               | 1. Klik menu data supplier. 3. Memilih data supplier yang akan diubah. 5. Melakukan perubahan data lalu menekan tombol                              |
| update.                                                                    | 2. Sistem menampilkan daftar data supplier. 4. Sistem menampilkan halaman form edit data supplier. 6. Sistem memvalidasi dan memperbarui data, lalu |
| menampilkan notifikasi data berhasil diubah.                               |                                                                                                                                                     |
| **Hapus data supplier**                                              | 1. Klik menu data supplier. 3. Memilih data supplier yang akan dihapus lalu klik                                                                    |
| tombol hapus. 5. Menekan tombol konfirmasi hapus.                          | 2. Sistem menampilkan daftar data supplier. 4. Sistem menampilkan konfirmasi penghapusan data. 6. Sistem menghapus data dan menampilkan notifikasi  |
| data berhasil dihapus.                                                     |                                                                                                                                                     |
| **Bidang Alternatif :**                                              | Jika data nama atau nomor telepon supplier tidak diisi                                                                                              |
| dengan benar, sistem menampilkan pesan kesalahan dan tidak menyimpan data. |                                                                                                                                                     |
| **Kesimpulan :**                                                     | Use case ini menjelaskan bagaimana cara admin                                                                                                       |
| mengelola data supplier bahan percetakan.                                  |                                                                                                                                                     |

# 5)

Use Case Narrative Pengelolaan Bahan

**Tabel
4.7 Use Case Narrative Pengelolaan Bahan**

| **Nama Use Case :**                                                                                  | Pengelolaan Bahan                                                                                                                               |
| ---------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------- |
| **ID Use Case :**                                                                                    | UC-05                                                                                                                                           |
| **Prioritas :**                                                                                      | Tinggi                                                                                                                                          |
| **Sumber :**                                                                                         | Tabel bahan                                                                                                                                     |
| **Pelaku Bisnis Utama :**                                                                            | Admin                                                                                                                                           |
| **Deskripsi :**                                                                                      | Proses pengelolaan data bahan/material percetakan                                                                                               |
| beserta stok yang tersedia di gudang.                                                                      |                                                                                                                                                 |
| **Prakondisi :**                                                                                     | Aktor admin telah login ke dalam sistem.                                                                                                        |
| **Bidang Khas Suatu Event**                                                                          | **Kegiatan Pelaku**                                                                                                                       |
| **Tambah data bahan**                                                                                | 1. Klik menu data bahan. 3. Klik tambah data bahan. 5. Mengisi nama bahan, satuan, stok, dan stok minimum,                                      |
| lalu menekan tombol simpan.                                                                                | 2. Sistem menampilkan daftar data bahan dalam bentuk                                                                                            |
| tabel. 4. Sistem menampilkan halaman form input data bahan. 6. Sistem memvalidasi dan menyimpan data, lalu |                                                                                                                                                 |
| menampilkan notifikasi data berhasil disimpan.                                                             |                                                                                                                                                 |
| **Ubah data bahan**                                                                                  | 1. Klik menu data bahan. 3. Memilih data bahan yang akan diubah. 5. Melakukan perubahan data lalu menekan tombol                                |
| update.                                                                                                    | 2. Sistem menampilkan daftar data bahan. 4. Sistem menampilkan halaman form edit data bahan. 6. Sistem memvalidasi dan memperbarui data, lalu   |
| menampilkan notifikasi data berhasil diubah.                                                               |                                                                                                                                                 |
| **Hapus data bahan**                                                                                 | 1. Klik menu data bahan. 3. Memilih data bahan yang akan dihapus lalu klik                                                                      |
| tombol hapus. 5. Menekan tombol konfirmasi hapus.                                                          | 2. Sistem menampilkan daftar data bahan. 4. Sistem menampilkan konfirmasi penghapusan data. 6. Sistem menghapus data dan menampilkan notifikasi |
| data berhasil dihapus.                                                                                     |                                                                                                                                                 |
| **Bidang Alternatif :**                                                                              | Jika stok yang diinput bernilai negatif, sistem                                                                                                 |
| menampilkan pesan kesalahan dan tidak menyimpan perubahan.                                                 |                                                                                                                                                 |
| **Kesimpulan :**                                                                                     | Use case ini menjelaskan bagaimana cara admin                                                                                                   |
| mengelola data bahan/material percetakan beserta stoknya.                                                  |                                                                                                                                                 |

# 6)

Use Case Narrative Proses Transaksi Cetak

**Tabel
4.8 Use Case Narrative Proses Transaksi Cetak**

| **Nama Use Case :**                                                  | Proses Transaksi Cetak                                                                              |
| -------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------- |
| **ID Use Case :**                                                    | UC-06                                                                                               |
| **Prioritas :**                                                      | Tinggi                                                                                              |
| **Sumber :**                                                         | Tabel transaksi_cetak, Tabel detail_transaksi                                                       |
| **Pelaku Bisnis Utama :**                                            | Admin                                                                                               |
| **Deskripsi :**                                                      | Proses pencatatan transaksi cetak berdasarkan                                                       |
| pemesanan dengan memilih produk dan jumlah; sistem menghitung total biaya  |                                                                                                     |
| secara otomatis serta memperbarui status pesanan.                          |                                                                                                     |
| **Prakondisi :**                                                     | Aktor admin telah login dan data konsumen serta data produk                                         |
| telah tersedia pada sistem.                                                |                                                                                                     |
| **Bidang Khas Suatu Event**                                          | **Kegiatan Pelaku**                                                                           |
| **Transaksi Cetak Baru**                                             | 1. Klik menu transaksi cetak baru. 3. Memilih data konsumen atau pemesanan, memilih                 |
| produk, dan menginput jumlah cetak, lalu menekan tombol simpan.            | 2. Sistem menampilkan form input transaksi cetak. 4. Sistem menghitung total biaya secara otomatis, |
| menyimpan data transaksi, dan memperbarui status pesanan.                  |                                                                                                     |
| **Bidang Alternatif :**                                              | Jika jumlah cetak tidak diisi atau produk belum                                                     |
| dipilih, sistem menampilkan pesan kesalahan dan tidak menyimpan transaksi. |                                                                                                     |
| **Kesimpulan :**                                                     | Use case ini menjelaskan bagaimana cara admin mencatat                                              |
| transaksi cetak baru ke dalam sistem.                                      |                                                                                                     |

# 7)

Use Case Narrative Buat Pemesanan

**Tabel
4.10 Use Case Narrative Buat Pemesanan**

| **Nama Use Case :**                                                     | Buat Pemesanan                                                                       |
| ----------------------------------------------------------------------------- | ------------------------------------------------------------------------------------ |
| **ID Use Case :**                                                       | UC-08                                                                                |
| **Prioritas :**                                                         | Tinggi                                                                               |
| **Sumber :**                                                            | Tabel pemesanan                                                                      |
| **Pelaku Bisnis Utama :**                                               | Admin, Konsumen                                                                      |
| **Deskripsi :**                                                         | Proses pemesanan produk cetak secara online oleh                                     |
| konsumen maupun pengelolaan data pemesanan yang masuk oleh admin.             |                                                                                      |
| **Prakondisi :**                                                        | Aktor konsumen telah login ke sistem, atau aktor admin                               |
| telah login dengan hak akses untuk mengelola pemesanan.                       |                                                                                      |
| **Bidang Khas Suatu Event**                                             | **Kegiatan Pelaku**                                                            |
| **Konsumen membuat pemesanan**                                          | 1. Klik menu pemesanan. 3. Memilih produk, mengisi jumlah dan ukuran cetak,          |
| lalu menekan tombol konfirmasi.                                               | 2. Sistem menampilkan form pemesanan beserta daftar                                  |
| produk yang tersedia. 4. Sistem menyimpan data pemesanan dan menampilkan      |                                                                                      |
| notifikasi pemesanan berhasil.                                                |                                                                                      |
| **Admin mengelola data pemesanan**                                      | 1. Klik menu kelola pemesanan. 3. Melihat, mengubah, atau membatalkan data pemesanan |
| yang masuk.                                                                   | 2. Sistem menampilkan daftar pemesanan yang telah                                    |
| dibuat oleh konsumen. 4. Sistem memperbarui status pemesanan sesuai tindakan  |                                                                                      |
| admin.                                                                        |                                                                                      |
| **Bidang Alternatif :**                                                 | Jika stok bahan untuk produk yang dipilih tidak                                      |
| mencukupi, sistem menampilkan pesan bahwa pemesanan tidak dapat diproses.     |                                                                                      |
| **Kesimpulan :**                                                        | Use case ini menjelaskan bagaimana cara konsumen                                     |
| melakukan pemesanan produk cetak dan admin mengelola data pemesanan tersebut. |                                                                                      |

# 8)

Use Case Narrative Pengelolaan Pembelian

**Tabel
4.11 Use Case Narrative Pengelolaan Pembelian**

| **Nama Use Case :**                                              | Pengelolaan Pembelian                                                                                        |
| ---------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------ |
| **ID Use Case :**                                                | UC-09                                                                                                        |
| **Prioritas :**                                                  | Sedang                                                                                                       |
| **Sumber :**                                                     | Tabel pembelian, Tabel detail_pembelian                                                                      |
| **Pelaku Bisnis Utama :**                                        | Admin                                                                                                        |
| **Deskripsi :**                                                  | Proses pencatatan pembelian bahan dari supplier                                                              |
| apabila stok menipis, yang secara otomatis memperbarui stok bahan.     |                                                                                                              |
| **Prakondisi :**                                                 | Aktor admin telah login ke dalam sistem.                                                                     |
| **Bidang Khas Suatu Event**                                      | **Kegiatan Pelaku**                                                                                    |
| **Pembelian Bahan**                                              | 1. Klik menu pembelian bahan. 3. Memilih supplier, menambahkan bahan yang dibeli                             |
| beserta jumlahnya, lalu menekan tombol simpan.                         | 2. Sistem menampilkan daftar riwayat pembelian bahan. 4. Sistem menyimpan data pembelian dan secara otomatis |
| memperbarui stok bahan terkait.                                        |                                                                                                              |
| **Bidang Alternatif :**                                          | Jika supplier atau bahan yang dibeli belum dipilih,                                                          |
| sistem menampilkan pesan kesalahan dan tidak menyimpan data pembelian. |                                                                                                              |
| **Kesimpulan :**                                                 | Use case ini menjelaskan bagaimana cara admin mencatat                                                       |
| pembelian bahan dari supplier serta memperbarui stok bahan.            |                                                                                                              |

# 9)

Use Case Narrative Lihat Dashboard

**Tabel
4.12 Use Case Narrative Lihat Dashboard**

| **Nama Use Case :**                                           | Lihat Dashboard                                       |
| ------------------------------------------------------------------- | ----------------------------------------------------- |
| **ID Use Case :**                                             | UC-10                                                 |
| **Prioritas :**                                               | Sedang                                                |
| **Sumber :**                                                  | Tabel transaksi_cetak, Tabel pemesanan                |
| **Pelaku Bisnis Utama :**                                     | Admin, Pemilik                                        |
| **Deskripsi :**                                               | Menampilkan ringkasan informasi transaksi, pemesanan, |
| dan pendapatan pada halaman utama sistem.                           |                                                       |
| **Prakondisi :**                                              | Aktor admin atau pemilik telah login ke dalam sistem. |
| **Bidang Khas Suatu Event**                                   | **Kegiatan Pelaku**                             |
| **Lihat Dashboard**                                           | 1. Login ke dalam sistem dan mengakses halaman utama  |
| (dashboard).                                                        | 2. Sistem menampilkan ringkasan data berupa jumlah    |
| transaksi, jumlah pemesanan, dan total pendapatan secara real-time. |                                                       |
| **Bidang Alternatif :**                                       | -                                                     |
| **Kesimpulan :**                                              | Use case ini menjelaskan bagaimana aktor melihat      |
| ringkasan informasi sistem melalui dashboard.                       |                                                       |

# 10)Use

Case Narrative Cetak Laporan Transaksi

**Tabel
4.13 Use Case Narrative Cetak Laporan Transaksi**

| **Nama Use Case :**                                      | Cetak Laporan Transaksi                                                                                  |
| -------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------- |
| **ID Use Case :**                                        | UC-11                                                                                                    |
| **Prioritas :**                                          | Sedang                                                                                                   |
| **Sumber :**                                             | Tabel transaksi_cetak                                                                                    |
| **Pelaku Bisnis Utama :**                                | Admin, Pemilik                                                                                           |
| **Deskripsi :**                                          | Proses menampilkan dan mencetak laporan transaksi                                                        |
| cetak berdasarkan periode tertentu.                            |                                                                                                          |
| **Prakondisi :**                                         | Aktor admin atau pemilik telah login ke dalam sistem.                                                    |
| **Bidang Khas Suatu Event**                              | **Kegiatan Pelaku**                                                                                |
| **Cetak Laporan Transaksi**                              | 1. Klik menu laporan transaksi. 3. Menginput periode laporan yang diinginkan, lalu                       |
| menekan tombol cetak.                                          | 2. Sistem menampilkan form pilihan periode laporan. 4. Sistem menampilkan dan mencetak laporan transaksi |
| cetak sesuai periode yang dipilih dalam format PDF atau Excel. |                                                                                                          |
| **Bidang Alternatif :**                                  | Jika tidak ada data transaksi pada periode yang                                                          |
| dipilih, sistem menampilkan pesan data tidak ditemukan.        |                                                                                                          |
| **Kesimpulan :**                                         | Use case ini menjelaskan bagaimana cara admin dan                                                        |
| pemilik mencetak laporan transaksi cetak.                      |                                                                                                          |

**Bagian identitas tabel ini
(Prioritas, Sumber, Pelaku Bisnis Utama) tidak lengkap/rusak pada dokumen asli
sehingga dilengkapi mengikuti pola use case sejenis (UC-12). Mohon dicek
kembali kesesuaiannya.*

# 11)Use

Case Narrative Cetak Laporan Pemesanan

**Tabel
4.14 Use Case Narrative Cetak Laporan Pemesanan**

| **Nama Use Case :**                              | Cetak Laporan Pemesanan                                                                           |
| ------------------------------------------------------ | ------------------------------------------------------------------------------------------------- |
| **ID Use Case :**                                | UC-12                                                                                             |
| **Prioritas :**                                  | Sedang                                                                                            |
| **Sumber :**                                     | Database                                                                                          |
| **Pelaku Bisnis Utama :**                        | Admin, Pemilik                                                                                    |
| **Deskripsi :**                                  | Proses menampilkan dan mencetak laporan data pemesanan                                            |
| berdasarkan periode tertentu.                          |                                                                                                   |
| **Prakondisi :**                                 | Aktor admin atau pemilik telah login ke dalam sistem.                                             |
| **Bidang Khas Suatu Event**                      | **Kegiatan Pelaku**                                                                         |
| **Cetak Laporan Pemesanan**                      | 1. Klik menu laporan. 3. Menginput periode atau filter data yang diinginkan,                      |
| lalu menekan tombol cetak.                             | 2. Sistem menampilkan form filter laporan. 4. Sistem menampilkan dan mencetak laporan data sesuai |
| filter yang dipilih.                                   |                                                                                                   |
| **Bidang Alternatif :**                          | Jika tidak ada data pemesanan yang sesuai dengan                                                  |
| filter, sistem menampilkan pesan data tidak ditemukan. |                                                                                                   |
| **Kesimpulan :**                                 | Use case ini menjelaskan bagaimana cara admin dan                                                 |
| pemilik mencetak laporan data.                         |                                                                                                   |

# 12)Use

Case Narrative Login

**Tabel
4.15 Use Case Narrative Login**

| **Nama Use Case :**                                                    | Login                                                    |
| ---------------------------------------------------------------------------- | -------------------------------------------------------- |
| **ID Use Case :**                                                      | UC-13                                                    |
| **Prioritas :**                                                        | Tinggi                                                   |
| **Sumber :**                                                           | Tabel users                                              |
| **Pelaku Bisnis Utama :**                                              | Admin, Konsumen, Pemilik                                 |
| **Deskripsi :**                                                        | Proses autentikasi pengguna (admin, konsumen, maupun     |
| pemilik) untuk masuk ke dalam sistem dengan memasukkan username/email dan    |                                                          |
| password yang telah terdaftar.                                               |                                                          |
| **Prakondisi :**                                                       | Aktor telah memiliki akun yang terdaftar pada sistem     |
| dan berada pada halaman login.                                               |                                                          |
| **Bidang Khas Suatu Event**                                            | **Kegiatan Pelaku**                                |
| **Login**                                                              | 1. Menginput username/email dan password lalu menekan    |
| tombol login.                                                                | 2. Sistem memvalidasi kesesuaian data dengan tabel       |
| users. 3. Jika data sesuai, sistem mengarahkan pengguna ke                   |                                                          |
| halaman utama sesuai hak akses (Admin, Konsumen, atau Pemilik).              |                                                          |
| **Bidang Alternatif :**                                                | Jika username/email atau password tidak sesuai, sistem   |
| menampilkan pesan kesalahan dan tetap berada pada halaman login.             |                                                          |
| **Kesimpulan :**                                                       | Use case ini menjelaskan bagaimana cara admin, konsumen, |
| dan pemilik melakukan login untuk dapat mengakses sistem sesuai hak aksesnya |                                                          |
| masing-masing.<br /><br />                                                   |                                                          |

| **No**                                                                            | **NamaUseCase** | **Aktor**                                               | **Deskripsi**                                      |
| --------------------------------------------------------------------------------------- | --------------------- | ------------------------------------------------------------- | -------------------------------------------------------- |
| 1                                                                                       | Daftar                | Konsumen                                                      | Proses pendaftaran akun                                  |
| baru oleh konsumen dengan mengisi data seperti nama, username, dan password             |                       |                                                               |                                                          |
| agar dapat mengakses sistem.                                                            |                       |                                                               |                                                          |
| 2                                                                                       | Pengelolaan           |                                                               |                                                          |
| Konsumen                                                                                | Admin                 | Proses pengelolaan data                                       |                                                          |
| konsumen meliputi tambah, ubah, dan hapus data nama, nomor telepon, danalamat konsumen. |                       |                                                               |                                                          |
| 3                                                                                       | Pengelolaan           |                                                               |                                                          |
| Produk                                                                                  | Admin                 | Prosespengelolaandataprodukcetak beserta harga per satuan dan |                                                          |
| spesifikasi produk.                                                                     |                       |                                                               |                                                          |
| 4                                                                                       | Pengelolaan           |                                                               |                                                          |
| Supplier                                                                                | Admin                 | Proses pengelolaan data                                       |                                                          |
| supplier meliputi tambah, ubah, dan hapus data nama, kontak, dan alamatsupplier.        |                       |                                                               |                                                          |
| 5                                                                                       | Penggelolaan Bahan    | Admin                                                         | Proses pengelolaan databahan/material percetakan beserta |
| stok yang tersedia di gudang.                                                           |                       |                                                               |                                                          |
| 6                                                                                       | ProsesTransaksi Cetak | Admin                                                         | Proses pencatatan                                        |
| transaksi cetak berdasarkan pemesanan dengan memilih produk dan jumlah;                 |                       |                                                               |                                                          |
| sistem menghitung total biaya secara otomatis serta memperbarui statuspesanan.          |                       |                                                               |                                                          |
