# 🎓 WHTECH - Mini-Portal Akademik Kampus

Aplikasi web modern untuk manajemen daftar mata kuliah dengan fitur interaktif, API REST, dan antarmuka yang responsif menggunakan Laravel, Vue.js, dan TailwindCSS.

## 📋 Daftar Isi

- [Fitur Utama](#fitur-utama)
- [Teknologi yang Digunakan](#teknologi-yang-digunakan)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Cara Menjalankan](#cara-menjalankan)
- [Dokumentasi API](#dokumentasi-api)
- [Struktur Proyek](#struktur-proyek)
- [Kontribusi](#kontribusi)

## ✨ Fitur Utama

### 1. 📚 Daftar Mata Kuliah
- Tampilan responsive dengan grid layout yang menarik
- Card design modern dengan informasi lengkap mata kuliah
- Menampilkan: Kode, Nama, SKS, Dosen, Deskripsi, dan Kategori

### 2. 🔍 Fitur Interaktif (API & JavaScript)

#### Pencarian Real-time
- Saat user mengetik nama mata kuliah, daftar di bawahnya otomatis terfilter tanpa melakukan refresh halaman (Full Page Reload)
- Pencarian berfungsi untuk nama mata kuliah, kode, dan deskripsi

#### Filter Kategori
- Filter dinamis berdasarkan kategori (Wajib/Peminatan)
- Kombinasi dengan pencarian untuk hasil yang lebih spesifik

#### Pagination
- Pagination interaktif dengan navigasi halaman yang intuitif
- Load 9 item per halaman (dapat dikonfigurasi)
- Smooth scrolling ke halaman selanjutnya

### Mekanisme:
1. Buat API Endpoint di `routes/api.php` yang mengembalikan data JSON berdasarkan query pencarian
2. Gunakan JavaScript (Fetch API) untuk memanggil API tersebut secara asinkron
3. Update DOM secara dinamis menggunakan data dari API tanpa page reload

### 3. 🎨 Standar Styling (TailwindCSS)

#### Layout Responsive
- Mobile-first approach dengan responsive breakpoints (sm, md, lg)
- Grid layout yang adaptif di berbagai ukuran layar

#### State Visual pada Elemen
- **Hover Effects**: Perubahan warna dan shadow saat cursor melewati tombol/card
- **Focus States**: Visual feedback saat input field difokuskan
- **Active States**: Indikator halaman aktif pada pagination
- **Loading State**: Spinner animasi saat data sedang dimuat

#### Tema Warna: Hijau Muda & Putih
- **Primary Color**: Hijau (#10B981 - Emerald-500)
- **Secondary Color**: Putih (#FFFFFF)
- **Accent Colors**: Merah untuk Wajib, Hijau untuk Peminatan
- **Background**: Gradient hijau-putih untuk header
- **Borders**: Subtle green borders untuk card accents

#### Pagination Styling
- Tombol Previous/Next dengan styling yang jelas
- Page number buttons dengan highlight pada halaman aktif
- Hover effects untuk interaktivitas

### 4. 📊 Statistik Dashboard
- Total mata kuliah keseluruhan
- Jumlah mata kuliah wajib
- Jumlah mata kuliah peminatan
- Update real-time berdasarkan filter yang diterapkan

## 🛠 Teknologi yang Digunakan

### Backend
- **Framework**: Laravel 11
- **Database**: SQLite 3
- **Language**: PHP 8.5.2
- **API**: RESTful API dengan JSON response

### Frontend
- **Template Engine**: Blade (Server-Side Rendering)
- **CSS Framework**: TailwindCSS
- **Build Tool**: Vite
- **JavaScript**: Vanilla JavaScript (Fetch API)
- **Icons**: Unicode Emojis

### DevOps
- **Package Manager**: Composer (PHP), npm (Node.js)
- **Web Server**: Laravel Artisan (Development)

## 📦 Persyaratan Sistem

- PHP 8.0 atau lebih tinggi (versi project: 8.5.2)
- Composer
- Node.js & npm
- SQLite3 Extension untuk PHP
- Browser modern (Chrome, Firefox, Safari, Edge)

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/hasanamirul/WHTECH-2026.git
cd WHTECH-2026
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Setup Environment

```bash
# Copy .env.example ke .env
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup

```bash
# Run migrations dan seeders
php artisan migrate:fresh --seed
```

Seeder akan membuat 16 mata kuliah dummy dengan variasi kategori (Wajib & Peminatan).

## 🎯 Cara Menjalankan

### Development Mode

```bash
# Terminal 1: Jalankan Laravel Development Server
php artisan serve

# Terminal 2: Jalankan Vite untuk asset compilation
npm run dev
```

Server akan berjalan di:
- **Laravel**: http://localhost:8000
- **Halaman Daftar Mata Kuliah**: http://localhost:8000/courses

### Build untuk Production

```bash
npm run build
php artisan optimize
```

## 📡 Dokumentasi API

### Base URL
```
/api
```

### Endpoints

#### 1. Get All Courses with Pagination
```
GET /api/courses?page=1&per_page=9
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": "uuid",
      "course_code": "CS101",
      "name": "Algoritma & Pemrograman",
      "sks": 3,
      "lecturer": "Dr. Budi Santoso",
      "description": "...",
      "category": "Wajib",
      "created_at": "2026-01-28T...",
      "updated_at": "2026-01-28T..."
    }
  ],
  "pagination": {
    "current_page": 1,
    "last_page": 2,
    "total": 16,
    "per_page": 9
  }
}
```

#### 2. Search Courses
```
GET /api/courses/search?q=algoritma&category=Wajib&page=1&per_page=9
```

**Query Parameters:**
- `q`: Kata kunci pencarian (opsional)
- `category`: Filter kategori - "Wajib" atau "Peminatan" (opsional)
- `page`: Nomor halaman (default: 1)
- `per_page`: Item per halaman (default: 9)

**Response:** Sama seperti endpoint pertama

## 📁 Struktur Proyek

```
WHTECH-2026/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── CourseController.php         # Controller dengan methods API
│   │   └── Requests/
│   ├── Models/
│   │   └── Course.php                       # Model dengan UUID support
│   └── Providers/
├── database/
│   ├── migrations/
│   │   └── 2026_01_28_023648_create_courses_table.php
│   ├── seeders/
│   │   ├── CourseSeeder.php                 # 16 data dummy mata kuliah
│   │   └── DatabaseSeeder.php
│   └── database.sqlite                      # SQLite database file
├── resources/
│   ├── css/
│   │   └── app.css                          # TailwindCSS styles
│   ├── js/
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views/
│       ├── courses/
│       │   └── index.blade.php              # Halaman daftar dengan Fetch API
│       └── layouts/
│           ├── app.blade.php
│           ├── navbar.blade.php             # Navigation dengan tema hijau
│           └── footer.blade.php
├── routes/
│   ├── api.php                              # API routes
│   ├── web.php                              # Web routes
│   ├── auth.php
│   └── console.php
├── public/
│   └── index.php
├── config/
├── bootstrap/
├── storage/
├── tests/
├── vendor/                                  # Composer dependencies
├── node_modules/                            # NPM dependencies
├── .env                                     # Environment configuration
├── .env.example
├── composer.json
├── package.json
├── vite.config.js
├── tailwind.config.js
├── README.md                                # File ini
└── artisan
```

## 🎨 Warna dan Tema

### Palet Warna Utama
- **Primary Green (Hijau Muda)**: `#10B981` (Emerald-500)
- **Light Green**: `#A7F3D0` (Emerald-200)
- **White**: `#FFFFFF`
- **Light Gray**: `#F3F4F6`
- **Dark Gray**: `#374151`

### Penggunaan Warna
- **Header & Navigation**: Gradient hijau
- **Buttons**: Hijau dengan hover lebih gelap
- **Card Borders**: Hijau subtle dengan gradient header
- **Active States**: Hijau yang lebih terang
- **Kategori Wajib**: Badge merah
- **Kategori Peminatan**: Badge hijau

## 📊 Data yang Di-seed

Seeder menyiapkan 16 mata kuliah dengan distribusi:
- **10 Mata Kuliah Wajib**: CS101-CS105, IT101-IT102, dan lainnya
- **6 Mata Kuliah Peminatan**: CS201-CS205, IT201-IT204

Setiap mata kuliah mencakup:
- Kode unik
- Nama mata kuliah
- Jumlah SKS
- Nama dosen pengampu
- Deskripsi lengkap
- Kategori (Wajib/Peminatan)

## 🔧 Konfigurasi

### Environment Variables (.env)

```env
APP_NAME=WHTECH
APP_ENV=local
APP_DEBUG=true
APP_KEY=base64:...

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

# Opsional untuk production
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=whtech
# DB_USERNAME=root
# DB_PASSWORD=
```

## 📝 Lisensi

Project ini dibuat untuk keperluan ujian seleksi WHTECH.

## 👥 Kontribusi

Kontribusi terbuka untuk improvement dan bug fixes. Silakan fork repository dan submit pull request.

## 📞 Kontak & Support

- **Email**: info@whtech.id
- **GitHub**: github.com/hasanamirul/WHTECH-2026
- **Repository**: https://github.com/hasanamirul/WHTECH-2026

---

**Status**: ✅ Production Ready  
**Last Updated**: 28 Januari 2026  
**Version**: 1.0.0

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
