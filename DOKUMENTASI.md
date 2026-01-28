# 📚 WHTECH - Mini-Portal Akademik Kampus

Dokumentasi lengkap implementasi ujian seleksi WHTECH dengan Laravel.

## ✅ Fitur yang Telah Diimplementasikan

### 1. Database Migration & Seeder

#### File Migration
- **Lokasi**: [database/migrations/2026_01_28_023648_create_courses_table.php](database/migrations/2026_01_28_023648_create_courses_table.php)
- **Struktur Tabel `courses`**:
  - `id` (UUID) - Primary Key
  - `course_code` (String, Unique) - Kode mata kuliah (contoh: "CS101")
  - `name` (String) - Nama mata kuliah (contoh: "Algoritma & Pemrograman")
  - `sks` (Integer) - Jumlah SKS (contoh: 3)
  - `lecturer` (String) - Nama dosen pengampu
  - `description` (Text) - Deskripsi mata kuliah
  - `category` (Enum) - Kategori: "Wajib" atau "Peminatan"
  - `timestamps` - created_at & updated_at

#### File Seeder
- **Lokasi**: [database/seeders/CourseSeeder.php](database/seeders/CourseSeeder.php)
- **Jumlah Data**: 16 mata kuliah dummy dengan variasi:
  - 10 Mata Kuliah Wajib
  - 6 Mata Kuliah Peminatan
- **Setiap data mencakup**: Kode, Nama, SKS, Dosen, Deskripsi, dan Kategori

**Contoh Data:**
```
CS101 - Algoritma & Pemrograman (3 SKS) - Dr. Budi Santoso - Wajib
CS102 - Struktur Data (3 SKS) - Prof. Siti Nurhaliza - Wajib
CS201 - Mobile Development (4 SKS) - Dr. Haris Supriyanto - Peminatan
... dan seterusnya (16 data total)
```

### 2. Model & Controller

#### Course Model
- **Lokasi**: [app/Models/Course.php](app/Models/Course.php)
- **Fitur**:
  - Menggunakan UUID sebagai primary key
  - Mass assignable fields: course_code, name, sks, lecturer, description, category

#### CourseController
- **Lokasi**: [app/Http/Controllers/CourseController.php](app/Http/Controllers/CourseController.php)
- **Methods**:
  - `index()` - Menampilkan daftar semua mata kuliah
  - `show()` - Menampilkan detail mata kuliah individual

### 3. Routing

- **Lokasi**: [routes/web.php](routes/web.php)
- **Route Daftar Mata Kuliah**: `GET /courses` → `CourseController@index`

### 4. Views & Template

#### Layout Structure
- **Base Layout**: [resources/views/layouts/app.blade.php](resources/views/layouts/app.blade.php)
- **Navbar**: [resources/views/layouts/navbar.blade.php](resources/views/layouts/navbar.blade.php) - Navigation dengan menu daftar kuliah, dashboard, login/register
- **Footer**: [resources/views/layouts/footer.blade.php](resources/views/layouts/footer.blade.php) - Footer dengan informasi dan kontak

#### Halaman Daftar Mata Kuliah
- **Lokasi**: [resources/views/courses/index.blade.php](resources/views/courses/index.blade.php)
- **Fitur**:
  ✨ **Server-Side Rendering (SSR)** dengan Laravel Blade
  - Tampilan Responsive dengan TailwindCSS
  - Grid Layout (1 kolom mobile, 2 kolom tablet, 3 kolom desktop)
  - Setiap kartu menampilkan:
    - Kode dan Nama Mata Kuliah (header)
    - SKS dengan ikon 📚
    - Nama Dosen Pengampu dengan ikon 👨‍🏫
    - Deskripsi singkat (3 baris maksimal)
    - Badge kategori (Wajib/Peminatan)
    - Link "Lihat Detail"
  
  **Filter & Pencarian Client-Side:**
  - Filter berdasarkan kategori (Wajib/Peminatan/Semua)
  - Pencarian real-time berdasarkan nama atau kode mata kuliah
  
  **Statistik:**
  - Total mata kuliah
  - Jumlah mata kuliah wajib
  - Jumlah mata kuliah peminatan

### 5. Styling & UI

- **Framework CSS**: TailwindCSS (sudah dikonfigurasi di `tailwind.config.js`)
- **Color Scheme**:
  - Primary: Blue (#3B82F6)
  - Secondary: Gray
  - Success: Green
  - Warning: Red
- **Responsive Design**: Mobile-first approach dengan breakpoints md dan lg

## 🚀 Cara Menjalankan

### 1. Setup Database

```bash
# Jika menggunakan MySQL
php artisan migrate:fresh --seed

# Jika menggunakan SQLite (pastikan php sqlite extension tersedia)
# Edit .env untuk DB_CONNECTION=sqlite
php artisan migrate:fresh --seed
```

### 2. Jalankan Development Server

```bash
php artisan serve
```

Server akan berjalan di `http://localhost:8000`

### 3. Akses Halaman

- **Halaman Daftar Mata Kuliah**: `http://localhost:8000/courses`
- **Dashboard** (jika login): `http://localhost:8000/dashboard`

## 📁 Struktur File yang Dibuat/Dimodifikasi

```
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── CourseController.php (BARU)
│   └── Models/
│       └── Course.php (BARU)
├── database/
│   ├── migrations/
│   │   └── 2026_01_28_023648_create_courses_table.php (DIMODIFIKASI)
│   └── seeders/
│       ├── CourseSeeder.php (BARU)
│       └── DatabaseSeeder.php (DIMODIFIKASI)
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── navbar.blade.php (DIMODIFIKASI)
│       │   └── footer.blade.php (DIMODIFIKASI)
│       └── courses/
│           └── index.blade.php (BARU)
└── routes/
    └── web.php (DIMODIFIKASI)
```

## 🎨 Tampilan Halaman

### Halaman Daftar Mata Kuliah Features:

1. **Header Section**
   - Judul "Daftar Mata Kuliah"
   - Deskripsi singkat
   - Background gradient blue

2. **Filter Section**
   - Dropdown filter kategori
   - Input field untuk pencarian

3. **Course Cards**
   - Design modern dengan shadow dan hover effect
   - Gradient header dengan kode dan kategori badge
   - Informasi SKS dan Dosen dengan icon
   - Deskripsi truncated
   - Kategori badge (merah untuk Wajib, hijau untuk Peminatan)
   - "Lihat Detail" link

4. **Statistics Cards**
   - Total mata kuliah
   - Mata kuliah wajib
   - Mata kuliah peminatan

## 📋 Data Seeder

16 Mata Kuliah yang di-seed ke database:

### Mata Kuliah Wajib (10):
1. CS101 - Algoritma & Pemrograman
2. CS102 - Struktur Data
3. CS103 - Database Management System
4. CS104 - Web Development
5. CS105 - Network & Communication
6. IT101 - Pemrograman Object Oriented
7. IT102 - Software Engineering
8. (dan 2 lainnya...)

### Mata Kuliah Peminatan (6):
1. CS201 - Mobile Development
2. CS202 - Machine Learning
3. CS203 - Cloud Computing
4. CS204 - Cybersecurity
5. IT201 - Big Data Analytics
6. IT202 - Artificial Intelligence
7. IT203 - DevOps & CI/CD
8. IT204 - Blockchain Technology

## 🔧 Teknologi yang Digunakan

- **Framework**: Laravel 11
- **Database**: SQLite / MySQL
- **Frontend**: Blade Template Engine, TailwindCSS
- **PHP Version**: 8.5.2
- **Node**: Node.js (untuk npm packages)

## 📝 Notes

- Semua data sudah bervariasi dengan dosen, deskripsi, dan kategori yang berbeda
- Filter dan pencarian berjalan di client-side menggunakan JavaScript vanilla
- Responsive design menggunakan TailwindCSS grid system
- Sesuai dengan requirement SSR menggunakan Laravel Blade
- Struktur layout menggunakan @extends dan @include components

---

**Status**: ✅ Siap untuk dijalankan dan dikembangkan lebih lanjut
**Last Updated**: 28 Januari 2026
