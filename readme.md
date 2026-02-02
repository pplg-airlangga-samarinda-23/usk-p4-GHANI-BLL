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

## Akun Demo

Username : magang
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
