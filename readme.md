## Judul

Perpus-V1

## ୧⍤⃝Identitas

- Nama : Ghani
- Sekolah : SMK TI Airlangga
- Jurusan : PPLG

## Tujuan

Sistem Manajemen Perpustakaan berbasis web ini dibuat untuk mengelola data buku, anggota, peminjaman dan pengembalian secara terstruktur dan mudah.

## Deskripsi

Aplikasi ini merupakan Sistem Manajemen Perpustakaan berbasis web yang dibuat untuk membantu sekolah dalam mengelola data buku dan data siswa (anggota perpustakaan) secara terstruktur dan efisien.

Sistem ini memudahkan admin dalam mencatat koleksi buku, mengatur data anggota/siswa, serta mengelola proses peminjaman dan pengembalian buku sehingga semua data tersimpan rapi di dalam database dan lebih mudah dicari kembali.

## Fitur Apa Saja ?

```bash
Anggota
- Login & Registrasi
- Dashboard Anggota
- Melihat Daftar Buku
- Mencari Buku
- Meminjam & Mengembalikan Buku

Admin
- Login & Logout
- Dashboard Admin
- Manajemen Anggota (CRUD)
- Manajemen Buku (CRUD)
- Manajemen Peminjaman & Pengembalian
```

## Tampilan Dashboard

<p align="center">
  <img src="foto/admin.png" width="300" />
  <img src="foto/siswa.png" width="300" />
</p>

## Cara Menggunakan

1. Clone repository:

```bash
  git clone https://github.com/pplg-airlangga-samarinda-23/usk-p4-GHANI-BLL.git
```

2. Buka folder project di `File Manager`
3. Jalankan usk-p4-GHANI-BLL menggunakan browser
   atau gunakan Live Server di `VS Code`

## Akun Demo

Username : magang <br>
Password : 123

## Struktur Folder

```bash
USK-P4-GHANIBLL/
├── anggota/              # Modul untuk anggota perpustakaan
│   ├── create.php
│   ├── delete.php
│   ├── edit.php
│   └── index.php
├── buku/                 # Modul untuk manajemen buku
│   ├── create.php
│   ├── delete.php
│   ├── edit.php
│   └── index.php
├── database/             # Database dan konfigurasi
│   ├── USK_GHANIBLL (1).sql
│   └── USK_GHANIBLL.sql
├── foto/                 # Folder penyimpanan gambar
│   ├── admin/
│   └── siswa/
├── peminjaman/           # Modul peminjaman buku
│   ├── create.php
│   ├── delete.php
│   ├── edit.php
│   ├── index.php
│   ├── dashboard-admin.php
│   ├── dashboard-anggota.php
│   ├── form-pengembalian.php
│   ├── form-pinjam.php
│   ├── koneksi.php
│   └── login_proses.php
├── login.css             # Styling untuk halaman login
├── login.php             # Halaman login
├── logout.php            # Proses logout
├── readme.md             # Dokumentasi proyek
├── register.php          # Halaman registrasi
├── register_proses.php   # Proses registrasi
└── styles.css            # Styling global
```

## Menggunakan Bahasa

![PHP](https://img.shields.io/badge/PHP-Native-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/Database-MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![HTML](https://img.shields.io/badge/HTML-Frontend-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS](https://img.shields.io/badge/CSS-Style-1572B6?style=for-the-badge&logo=css3&logoColor=white)
