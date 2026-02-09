# Panduan Aplikasi UKK RPL

Berdasarkan ERD (Entity Relationship Diagram) yang kamu berikan, ini adalah skema aplikasi UKK (Uji Kompetensi Keahlian) RPL atau proyek sejenis. Struktur datanya cukup "tricky" karena memisahkan tabel user (untuk admin/petugas) dan tabel pelanggan (untuk masyarakat), padahal keduanya butuh login.

Berikut adalah panduan lengkap mengenai apa saja yang perlu kamu buat di Laravel (Model, Migrasi, Controller) serta alur kerjanya.

## 1. Database Migration (Struktur Tabel)

Kamu harus membuat file migration sesuai dengan ERD. Pastikan nama kolom persis dengan gambar agar sesuai spesifikasi soal.

### create_levels_table
- id_level (Primary Key)
- nama_level (String)

### create_tarifs_table
- id_tarif (PK)
- daya (String/Int)
- tarifperkwh (Float/Decimal)

### create_users_table (Untuk Admin/Petugas)
- id_user (PK)
- username
- password (Hash)
- nama_admin
- id_level (Foreign Key ke tabel level)

### create_pelanggans_table (Untuk Masyarakat/Customer)
- id_pelanggan (PK)
- username
- password (Hash - Penting: Pelanggan butuh login)
- nomor_kwh
- nama_pelanggan
- alamat
- id_tarif (FK ke tabel tarif)

### create_penggunaans_table (Pencatatan Meteran)
- id_penggunaan (PK)
- id_pelanggan (FK)
- bulan, tahun
- meter_awal, meter_ahir (sesuaikan typo di gambar: "ahir")

### create_tagihans_table
- id_tagihan (PK)
- id_penggunaan (FK)
- id_pelanggan (FK)
- bulan, tahun
- jumlah_meter (Didapat dari: meter_ahir - meter_awal)
- status (Enum: 'Belum Bayar', 'Terbayar')

### create_pembayarans_table
- id_pembayaran (PK)
- id_tagihan (FK)
- id_pelanggan (FK) - Opsional jika sudah ada relasi via tagihan, tapi di ERD diminta.
- id_user (FK - Siapa admin yang memproses)
- tanggal_pembayaran, bulan_bayar
- biaya_admin, total_bayar

## 2. Models (Logika & Relasi)

Buat model berikut di folder `app/Models`.

- **Level.php**: hasMany ke User.
- **Tarif.php**: hasMany ke Pelanggan.
- **User.php**:
  - Harus extends Authenticatable (karena Admin perlu login).
  - Relasi belongsTo ke Level.
- **Pelanggan.php**:
  - Harus extends Authenticatable (karena Pelanggan perlu login).
  - Tambahkan Guard khusus di `config/auth.php` agar pelanggan bisa login terpisah.
  - Relasi belongsTo ke Tarif, hasMany ke Penggunaan/Tagihan.
- **Penggunaan.php**: Relasi belongsTo Pelanggan.
- **Tagihan.php**: Relasi belongsTo Penggunaan, belongsTo Pelanggan, hasOne Pembayaran.
- **Pembayaran.php**: Relasi belongsTo Tagihan, belongsTo User (admin).

## 3. Controllers (Pengendali Alur)

Pisahkan controller berdasarkan fitur dan hak aksesnya.

### A. AuthController
- `login()`: Menangani login. Cek apakah yang login Admin (cek tabel User) atau Pelanggan (cek tabel Pelanggan).
- `logout()`

### B. DashboardController
- Menampilkan halaman utama setelah login (beda tampilan antara Admin dan Pelanggan).

### C. Master Data (Hanya Admin)
- **TarifController**: CRUD data tarif (daya & harga).
- **PelangganController**: CRUD data pelanggan (Register pelanggan baru, pasang meteran baru).
- **UserController**: CRUD admin baru (opsional, biasanya admin dibuat via seeder/database langsung).

### D. Transaksi (Inti Aplikasi)
- **PenggunaanController (Admin)**:
  - Input meteran bulanan (mencatat meter_awal dan meter_ahir).
  - Otomatisasi: Saat data penggunaan disimpan, logika sebaiknya langsung menghitung jumlah_meter dan membuat data baru di tabel Tagihan dengan status 'Belum Bayar'.
- **TagihanController**:
  - (Admin): Melihat siapa saja yang belum bayar.
  - (Pelanggan): Melihat tagihan mereka sendiri.
- **PembayaranController**:
  - (Admin): Melakukan konfirmasi pembayaran. Input berapa uang yang dibayar, hitung kembalian, ubah status Tagihan jadi 'Terbayar', simpan ke tabel Pembayaran.
  - (Pelanggan): Melihat riwayat pembayaran (History).

## 4. Alur Kerja Aplikasi (Workflow)

Ini adalah jawaban untuk pertanyaan "Alurnya gimana":

### Tahap 1: Setup Awal (Oleh Admin Administrator)
- Admin login.
- Admin mengisi Data Tarif (Misal: 900VA = Rp 1000/kwh).
- Admin mendaftarkan Pelanggan Baru. (Input Nama, Alamat, dan pilih Daya/Tarif).

### Tahap 2: Pencatatan Meteran (Oleh Admin/Petugas Lapangan)
- Setiap bulan, Admin masuk ke menu Penggunaan.
- Admin memilih Pelanggan.
- Admin menginput meter_ahir bulan ini.
  - Sistem bekerja: meter_awal diambil otomatis dari meter_ahir bulan lalu.
  - Sistem bekerja: Menghitung jumlah_meter (ahir - awal).
  - Sistem bekerja: Otomatis generate Tagihan (Jumlah meter x Tarif per kwh) dengan status "Belum Bayar".

### Tahap 3: Pembayaran (Transaksi)

#### Skenario Pelanggan:
- Pelanggan login menggunakan username/password mereka.
- Masuk menu Tagihan.
- Melihat info tagihan bulan ini "Belum Lunas". (Pelanggan hanya melihat, biasanya bayarnya datang ke loket/admin).

#### Skenario Admin (Kasir):
- Pelanggan datang ke loket/Admin memberikan ID Pelanggan.
- Admin buka menu Pembayaran/Transaksi.
- Cari tagihan berdasarkan ID Pelanggan yang statusnya "Belum Bayar".
- Admin klik Bayar.
- Sistem menyimpan data ke tabel pembayaran, mengupdate status di tabel tagihan menjadi "Lunas/Terbayar".
- Cetak struk (opsional tapi bagus untuk nilai plus).

## Tips Tambahan untuk Laravel:
- **Multi-Auth**: Karena tabel user dan pelanggan pisah, kamu harus setting `config/auth.php`. Buat 2 guards: web (untuk user/admin) dan pelanggan (untuk pelanggan).
- **Relasi**: Hati-hati di tabel tagihan dan pembayaran. Pastikan saat pembayaran dibuat, id_tagihan yang disimpan valid.
