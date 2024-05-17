## SmartKidz - Aplikasi Website Pengelolaan Sistem Sekolah/Bimbel

**SmartKidz** adalah proyek pribadi yang saya kembangkan untuk mempermudah pengelolaan sistem sekolah melalui sebuah aplikasi web. Aplikasi ini dirancang untuk membantu mengelola data guru, siswa, kelas, serta berbagai aspek administrasi sekolah lainnya dengan lebih efisien dan terorganisir.

### Fitur Utama
- **Manajemen Guru**: Mengelola data dan informasi guru, termasuk penugasan dan jadwal mengajar.
- **Manajemen Unit**: Mengelola unit-unit pendidikan dalam sekolah, seperti departemen atau fakultas.
- **Manajemen Kota**: Mengelola data lokasi dan kota terkait sekolah untuk pelaporan dan administrasi.
- **Manajemen Kelas**: Mengelola data dan informasi kelas, termasuk jadwal dan kurikulum.
- **Manajemen Siswa**: Mengelola data siswa, mulai dari pendaftaran hingga perkembangan akademik.
- **Manajemen Absen**: Memantau dan mencatat kehadiran siswa secara terstruktur.
- **Manajemen Pelaporan Keuangan**: Mengelola dan membuat laporan keuangan sekolah.
- **Multi User View Privilege**: Sistem hak akses berdasarkan peran pengguna (admin, guru, siswa).
- **Cetak Invoice**: Membuat dan mencetak invoice pembayaran secara otomatis.
- **Cetak Raport Siswa**: Membuat dan mencetak raport siswa dengan mudah.
- **Export/Import Excel**: Mendukung eksport dan import data dalam format Excel untuk kemudahan pengelolaan data.
- **CRUD**: Fitur Create, Read, Update, Delete yang diterapkan pada semua entitas utama dalam sistem.

### Teknologi yang Digunakan
- **Framework**: Laravel ^10
- **Template**: Gantella
- **PHP**: Versi 8.1
- **Node.js**: Untuk manajemen paket JavaScript
- **Composer**: Untuk manajemen paket PHP

### Tentang Proyek
- **SmartKidz** adalah proyek pertama saya dalam membangun aplikasi pengelolaan sistem sekolah yang komprehensif.
- Menggunakan **Laravel ^10** sebagai framework utama, yang menawarkan fleksibilitas dan kekuatan dalam pengembangan aplikasi web.
- Desain antarmuka menggunakan template **Gantella**, memberikan tampilan yang profesional dan responsif.
- Sistem authorisasi menggunakan **Laravel UI** untuk manajemen otentikasi dan otorisasi pengguna.

### Persyaratan
- **PHP**: Versi 8.1 atau yang lebih baru.
- **Laravel**: Versi ^10 atau yang lebih baru.
- **Node.js**: Untuk manajemen paket JavaScript.
- **Composer**: Untuk manajemen paket PHP.

### Cara Menggunakan
1. **Instalasi**:
   - Clone repositori ini ke direktori lokal Anda.
   - Jalankan `composer install` untuk menginstal dependensi Laravel.
   - Jalankan `npm install` untuk menginstal dependensi JavaScript.
   - Copy `.env.example` menjadi `.env` dan sesuaikan konfigurasi database.
   - Jalankan `php artisan migrate` untuk migrasi database.
   - Jalankan `npm run dev` untuk mengkompilasi sumber daya JavaScript.
   - Jalankan `php artisan serve` untuk memulai aplikasi.

2. **Akses**:
   - Buka `http://localhost:8000` untuk mengakses halaman utama.
   - Gunakan kredensial yang sesuai untuk mengakses berbagai fitur sesuai dengan hak akses pengguna.

### Tujuan Proyek
Saya mengembangkan **SmartKidz** dengan tujuan untuk menciptakan solusi digital yang efektif dalam mengelola sistem sekolah. Proyek ini mencerminkan kemampuan saya dalam menggunakan teknologi modern seperti Laravel dan Node.js untuk membangun aplikasi web yang kompleks dan fungsional.

### Lisensi
Aplikasi ini dilisensikan di bawah [MIT License](LICENSE).
