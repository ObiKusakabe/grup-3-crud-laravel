# Konteks Presentasi Project: POS Fashion / FitStock

## 1. Ringkasan Project

Project ini adalah aplikasi web berbasis Laravel untuk membantu pengelolaan toko fashion. Aplikasi ini menggabungkan fitur POS/kasir, manajemen produk, manajemen stok per cabang, pencatatan transaksi, data supplier, data member, serta pengelolaan akun pegawai berdasarkan role.

Nama yang muncul pada aplikasi adalah **POS FASHION**, sedangkan title default layout menggunakan nama **FitStock**. Secara konsep, aplikasi ini cocok dijelaskan sebagai sistem Point of Sales dan inventory untuk toko fashion multi-cabang.

## 2. Latar Belakang

Bisnis fashion memiliki perputaran barang yang cepat. Produk bisa memiliki banyak variasi seperti kategori, ukuran, harga, dan stok yang tersebar di beberapa cabang. Jika proses pencatatan masih manual, toko akan kesulitan mengetahui jumlah stok aktual, riwayat transaksi, performa penjualan, serta barang mana yang mulai menipis.

Selain itu, toko juga membutuhkan pembagian tugas yang jelas. Kasir fokus melayani transaksi, tim inventaris fokus mengatur barang dan stok, sedangkan admin mengelola data utama seperti pegawai, cabang, produk, dan laporan transaksi. Karena itu, dibutuhkan aplikasi yang dapat menyatukan proses penjualan dan inventaris dalam satu sistem yang lebih terstruktur.

## 3. Masalah yang Dihadapi

- Pencatatan transaksi secara manual rawan salah hitung, terutama pada total bayar, diskon, tunai, dan kembalian.
- Stok barang sulit dipantau jika barang tersebar di beberapa cabang.
- Tidak ada pencatatan riwayat stok masuk dan stok keluar secara rapi.
- Data produk, kategori, supplier, dan member bisa tercecer jika tidak disimpan dalam satu sistem.
- Pemilik toko sulit melihat ringkasan performa penjualan harian dan kondisi stok rendah.
- Semua pegawai tidak seharusnya memiliki akses yang sama, sehingga perlu pembatasan role.

## 4. Solusi yang Ditawarkan

Aplikasi ini menyediakan sistem web terpadu untuk mengelola aktivitas toko fashion. Sistem menyimpan data produk, kategori, supplier, member, cabang, stok, pegawai, dan transaksi dalam database. Setiap transaksi yang dibuat melalui POS akan otomatis menghasilkan detail transaksi dan mengurangi stok produk pada cabang aktif.

Sistem juga menyediakan dashboard untuk melihat ringkasan bisnis, seperti penjualan hari ini, jumlah transaksi hari ini, total produk, stok rendah, dan transaksi terbaru. Selain itu, role pengguna dibagi menjadi admin, inventaris, dan POS/kasir agar setiap pengguna hanya mengakses fitur sesuai tugasnya.

## 5. Kegunaan Web

- Mencatat transaksi penjualan melalui halaman POS/kasir.
- Menghitung total bayar, diskon member, total akhir, pembayaran tunai, dan kembalian.
- Menyimpan riwayat transaksi beserta detail barang yang dibeli.
- Mengurangi stok secara otomatis ketika transaksi berhasil dibuat.
- Mengelola data barang fashion, termasuk kode barang/SKU, nama, ukuran, kategori, harga beli, harga jual, dan foto produk.
- Mengelola stok barang masuk dan barang keluar per cabang.
- Mencatat histori pergerakan stok melalui data stock movement.
- Menampilkan peringatan stok rendah berdasarkan batas minimum stok.
- Mengelola kategori barang agar produk lebih mudah dikelompokkan.
- Mengelola supplier sebagai data pemasok barang.
- Mengelola member dan diskon member.
- Mengelola cabang toko.
- Mengelola akun pegawai dengan role berbeda.
- Menampilkan dashboard ringkasan penjualan dan kondisi toko.

## 6. Fitur Utama Aplikasi

### Dashboard

Dashboard menampilkan ringkasan bisnis toko, yaitu penjualan hari ini, jumlah transaksi hari ini, total produk, jumlah produk dengan stok rendah, total penjualan tujuh hari terakhir, dan daftar transaksi terbaru.

### POS / Kasir

Fitur POS digunakan untuk membuat transaksi penjualan. Kasir memilih barang, memasukkan jumlah pembelian, memilih member jika ada, lalu sistem menghitung total pembayaran, diskon, total akhir, tunai, dan kembalian. Setelah transaksi disimpan, stok barang pada cabang aktif otomatis berkurang.

### Manajemen Barang

Fitur ini digunakan untuk mengelola data produk fashion. Data barang mencakup kode barang, nama produk, ukuran, kategori, harga beli, harga jual, dan foto. Kode barang dibuat otomatis dengan format yang memuat kode cabang, tanggal, dan nomor urut.

### Manajemen Stok

Fitur ini digunakan untuk mengatur stok produk di setiap cabang. User dapat mencatat stok masuk dan stok keluar, memilih cabang, memasukkan jumlah, alasan, dan catatan. Sistem juga menyimpan riwayat movement stok agar perubahan stok bisa dilacak.

### Manajemen Cabang

Admin dapat menambahkan, mengubah, dan menghapus data cabang. Aplikasi memiliki pilihan cabang aktif di bagian atas tampilan. Cabang aktif ini digunakan untuk menentukan stok mana yang sedang dilihat atau diproses.

### Manajemen Member

Member digunakan untuk menyimpan data pelanggan. Setiap member dapat memiliki diskon persen. Ketika transaksi menggunakan member, sistem menghitung diskon berdasarkan data member tersebut.

### Manajemen Supplier

Supplier digunakan untuk menyimpan informasi pemasok barang, seperti nama, telepon, dan alamat. Data ini membantu toko mengelola sumber barang.

### Manajemen Pegawai dan Role

Admin dapat membuat akun pegawai dan menentukan role. Role yang tersedia antara lain:

- **Admin**: mengakses dashboard, produk, stok, supplier, transaksi, member, pegawai, dan cabang.
- **Inventaris**: mengakses pengelolaan barang, kategori, supplier, manajemen stok, dan melihat transaksi.
- **POS/Kasir**: mengakses halaman POS, riwayat transaksi, dan daftar member.

## 7. Alur Aplikasi

### Alur Registrasi dan Login

1. Pengguna mendaftar melalui halaman signup.
2. Sistem membuat akun admin.
3. Sistem membuat data perusahaan/company.
4. Sistem membuat cabang default bernama Cabang Utama.
5. Admin otomatis login dan diarahkan ke dashboard.
6. Saat login berikutnya, sistem memilih cabang pertama sebagai cabang aktif.

### Alur Admin

1. Admin login ke sistem.
2. Admin melihat dashboard ringkasan bisnis.
3. Admin menambahkan cabang jika toko memiliki lebih dari satu lokasi.
4. Admin membuat akun pegawai untuk role POS atau inventaris.
5. Admin mengelola kategori, barang, supplier, dan member.
6. Admin dapat melihat riwayat transaksi dan menghapus transaksi jika dibutuhkan.

### Alur Inventaris

1. User inventaris login ke sistem.
2. User memilih cabang aktif.
3. User mengelola data barang, kategori, dan supplier.
4. User mencatat stok masuk saat barang datang.
5. User mencatat stok keluar jika ada pengurangan stok non-penjualan.
6. User memantau daftar produk dan stok rendah.

### Alur POS / Kasir

1. Kasir login ke sistem.
2. Kasir membuka menu POS/Kasir.
3. Kasir memilih barang yang dibeli pelanggan.
4. Kasir memasukkan jumlah barang.
5. Kasir memilih member jika pelanggan terdaftar.
6. Sistem menghitung subtotal, diskon, total akhir, tunai, dan kembalian.
7. Transaksi disimpan.
8. Sistem membuat detail transaksi.
9. Sistem mengurangi stok produk pada cabang aktif.
10. Riwayat transaksi dapat dilihat kembali.

## 8. Struktur Data Utama

- **Users**: menyimpan akun pengguna, role, company, dan pembuat akun.
- **Companies**: menyimpan data perusahaan/toko.
- **Branches**: menyimpan data cabang toko.
- **Barangs**: menyimpan data produk.
- **Kategori Barang**: menyimpan kategori produk.
- **Suppliers**: menyimpan data pemasok.
- **Members**: menyimpan data pelanggan dan diskon.
- **Transaksis**: menyimpan transaksi utama.
- **Detail Transaksis**: menyimpan rincian barang dalam transaksi.
- **Product Stocks**: menyimpan jumlah stok produk per cabang.
- **Stock Movements**: menyimpan riwayat barang masuk dan keluar.

## 9. Teknologi yang Digunakan

- **Laravel** sebagai framework backend.
- **PHP** sebagai bahasa pemrograman utama.
- **Blade Template** sebagai tampilan frontend.
- **Database Migration dan Seeder** untuk struktur dan data awal.
- **Vite** untuk build asset frontend.
- **Tailwind CSS** untuk styling.
- **Lucide Icons** untuk ikon pada navigasi dan tampilan.

## 10. Nilai Tambah Project

- Sudah mendukung konsep multi-company, sehingga data setiap perusahaan dipisahkan berdasarkan company_id.
- Sudah mendukung multi-branch, sehingga stok bisa dilihat dan dikelola per cabang.
- Memiliki role-based access control agar akses pengguna lebih aman dan sesuai tugas.
- Transaksi terhubung langsung dengan stok, sehingga penjualan otomatis memengaruhi persediaan.
- Dashboard membantu pemilik toko melihat kondisi bisnis secara cepat.
- Cocok untuk studi kasus toko fashion karena memiliki atribut ukuran, kategori, foto produk, dan alur kasir.

## 11. Kesimpulan

Aplikasi POS Fashion / FitStock merupakan sistem web yang membantu toko fashion mengelola penjualan dan inventaris secara lebih terstruktur. Dengan fitur POS, manajemen stok per cabang, data produk, supplier, member, pegawai, dan dashboard, aplikasi ini dapat mengurangi kesalahan pencatatan manual serta mempercepat proses operasional toko.

Project ini menunjukkan penerapan CRUD Laravel yang lebih lengkap karena tidak hanya menyimpan data, tetapi juga menghubungkan transaksi dengan stok, membatasi akses berdasarkan role, dan menyediakan ringkasan bisnis melalui dashboard.

## 12. Saran Tambahan untuk PPT

- Tambahkan slide **aktor pengguna**, berisi Admin, Inventaris, dan POS/Kasir.
- Tambahkan slide **diagram alur transaksi**, mulai dari pilih barang sampai stok berkurang otomatis.
- Tambahkan slide **diagram database sederhana**, berisi hubungan Company, Branch, Barang, ProductStock, Transaksi, dan DetailTransaksi.
- Tambahkan slide **keunggulan aplikasi**, misalnya multi-cabang, role akses, dashboard, dan update stok otomatis.
- Tambahkan slide **demo skenario**, misalnya: admin membuat barang, inventaris menambah stok, kasir membuat transaksi, lalu dashboard berubah.
- Tambahkan slide **pengembangan selanjutnya**, seperti cetak struk PDF, barcode scanner, laporan penjualan per periode, grafik stok, export Excel, dan notifikasi stok minimum.

## 13. Rekomendasi Susunan Slide PPT

1. Judul Project: POS Fashion / FitStock
2. Latar Belakang
3. Masalah
4. Solusi
5. Tujuan dan Kegunaan Web
6. Aktor dan Hak Akses
7. Fitur Utama
8. Alur Aplikasi
9. Alur Transaksi POS
10. Struktur Data / Database
11. Teknologi yang Digunakan
12. Nilai Tambah Project
13. Kesimpulan
14. Saran Pengembangan

## 14. Prompt Siap Pakai untuk AI Pembuat PPT

Buatkan presentasi PowerPoint dari konteks project berikut. Gunakan bahasa Indonesia yang formal tetapi mudah dipahami mahasiswa. Buat slide ringkas, visual, dan cocok untuk presentasi kelas. Project adalah aplikasi web POS Fashion / FitStock berbasis Laravel untuk mengelola penjualan dan stok toko fashion. Isi presentasi harus mencakup latar belakang, masalah, solusi, kegunaan web, fitur utama, alur aplikasi, role pengguna, struktur data, teknologi, nilai tambah, kesimpulan, dan saran pengembangan. Gunakan poin-poin pendek di slide, lalu tambahkan speaker notes yang menjelaskan setiap slide.

