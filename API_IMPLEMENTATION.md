# Dokumentasi Implementasi API & JavaScript - WHTECH Mini-Portal Akademik

## 3. Fitur Interaktif (API & JavaScript)

### Deskripsi Requirement
Tambahkan fitur pencarian (Search Bar) di bagian atas daftar mata kuliah dengan ketentuan:
- **Pencarian Real-time**: Saat user mengetik nama mata kuliah, daftar di bawahnya otomatis terfilter tanpa melakukan refresh halaman (Full Page Reload)
- **Mekanisme**: 
  1. Buatlah API Endpoint di routes/api.php yang mengembalikan data JSON berdasarkan query pencarian
  2. Gunakan JavaScript (Fetch API atau Axios) untuk memanggil API tersebut
  3. Update DOM secara dinamis menggunakan data dari API

---

## Implementasi Lengkap

### 1. API Endpoint (`routes/api.php`)

```php
Route::get('/courses/search', [CourseController::class, 'apiSearch']);
```

**URL**: `GET /api/courses/search`

**Query Parameters**:
- `q` (string): Query pencarian (nama mata kuliah, kode, nama dosen)
- `category` (string): Filter kategori (Wajib/Peminatan) - optional
- `page` (integer): Nomor halaman - default: 1
- `per_page` (integer): Item per halaman - default: 9

**Response JSON**:
```json
{
  "success": true,
  "data": [
    {
      "id": "uuid",
      "course_code": "CS101",
      "name": "Algoritma & Pemrograman",
      "sks": 3,
      "lecturer": "Dr. Ahmad Wijaya, S.T., M.T.",
      "description": "...",
      "category": "Wajib"
    }
  ],
  "pagination": {
    "current_page": 1,
    "last_page": 3,
    "total": 20,
    "per_page": 9
  }
}
```

---

### 2. Controller Implementation (`app/Http/Controllers/CourseController.php`)

```php
public function apiSearch(Request $request)
{
    $query = $request->q;
    $category = $request->category;
    $perPage = $request->per_page ?? 9;

    $courses = Course::query();

    // Filter berdasarkan query pencarian
    if (!empty($query)) {
        $courses->where(function ($q) use ($query) {
            $q->where('name', 'like', "%$query%")
              ->orWhere('course_code', 'like', "%$query%")
              ->orWhere('lecturer', 'like', "%$query%");
        });
    }

    // Filter berdasarkan kategori
    if (!empty($category)) {
        $courses->where('category', $category);
    }

    $courses = $courses->paginate($perPage);

    return response()->json([
        'success' => true,
        'data' => $courses->items(),
        'pagination' => [
            'current_page' => $courses->currentPage(),
            'last_page' => $courses->lastPage(),
            'total' => $courses->total(),
            'per_page' => $courses->perPage(),
        ]
    ]);
}
```

---

### 3. Frontend Implementation (`resources/views/courses/index.blade.php`)

#### HTML Search Bar
```html
<div class="bg-white p-6 rounded-lg shadow-md mb-8">
    <h2 class="text-xl font-bold mb-4">Filter & Pencarian</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-2">Filter Kategori</label>
            <select id="categoryFilter"
                class="w-full border-2 border-green-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                <option value="" selected>Semua Kategori</option>
                <option value="Wajib">Wajib</option>
                <option value="Peminatan">Peminatan</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium mb-2">Cari Mata Kuliah</label>
            <input id="searchInput" type="text" 
                placeholder="Cari berdasarkan nama, kode, atau dosen..."
                class="w-full border-2 border-green-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
    </div>
</div>
```

#### JavaScript Implementation (Fetch API)

```javascript
document.addEventListener('DOMContentLoaded', function () {
    const API_URL = "/api/courses/search";
    let currentPage = 1;
    let currentQuery = "";
    let currentCategory = "";

    const coursesContainer = document.getElementById('coursesContainer');
    const paginationContainer = document.getElementById('paginationContainer');
    const emptyState = document.getElementById('emptyState');
    const loading = document.getElementById('loading');
    const categoryFilter = document.getElementById('categoryFilter');
    const searchInput = document.getElementById('searchInput');

    // 1. FETCH DATA DARI API
    async function loadCourses(page = 1) {
        loading.classList.remove('hidden');
        emptyState.classList.add('hidden');
        coursesContainer.innerHTML = "";
        paginationContainer.innerHTML = "";

        const params = new URLSearchParams({
            q: currentQuery,
            category: currentCategory,
            page: page,
            per_page: 9
        });

        const url = `${API_URL}?${params.toString()}`;
        
        try {
            const res = await fetch(url);
            const result = await res.json();

            loading.classList.add('hidden');

            if (result.success && result.data && result.data.length > 0) {
                renderCourses(result.data);
                renderPagination(result.pagination);
                updateStatistics();
            } else {
                emptyState.classList.remove('hidden');
            }
        } catch (e) {
            console.error("Error:", e);
            loading.classList.add('hidden');
            emptyState.classList.remove('hidden');
        }
    }

    // 2. UPDATE DOM DENGAN COURSE CARDS
    function renderCourses(courses) {
        coursesContainer.innerHTML = courses.map(c => `
            <div class="bg-white p-5 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <div class="bg-gradient-to-r from-green-400 to-green-500 p-4 rounded-t-lg mb-4 -m-5 mb-4">
                    <p class="text-green-100 text-sm font-bold">${c.course_code}</p>
                    <h3 class="font-bold text-lg text-white mt-1">${c.name}</h3>
                </div>
                <div class="space-y-2">
                    <p class="text-sm"><strong>SKS:</strong> ${c.sks}</p>
                    <p class="text-sm"><strong>Dosen:</strong> ${c.lecturer}</p>
                    <p class="text-sm text-gray-600 line-clamp-2">${c.description}</p>
                    <div class="mt-3 pt-3 border-t">
                        <span class="inline-block px-3 py-1 text-xs font-bold rounded-full
                            ${c.category === 'Wajib' ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600'}">
                            ${c.category === 'Wajib' ? '✓ Wajib' : '★ Peminatan'}
                        </span>
                    </div>
                </div>
            </div>
        `).join('');
    }

    // 3. EVENT LISTENERS UNTUK REAL-TIME SEARCH (TANPA RELOAD)
    
    // Saat user mengetik di search bar
    searchInput.addEventListener('keyup', e => {
        currentQuery = e.target.value;
        currentPage = 1;
        loadCourses(); // Fetch data otomatis tanpa reload halaman
    });

    // Saat user mengubah filter kategori
    categoryFilter.addEventListener('change', e => {
        currentCategory = e.target.value;
        currentPage = 1;
        loadCourses(); // Fetch data otomatis tanpa reload halaman
    });

    // Load data saat halaman pertama kali dibuka
    loadCourses();
});
```

---

## Fitur Tambahan

### Real-Time Search
- User mengetik di search input → `keyup` event triggered
- Query diubah → `loadCourses()` dipanggil
- API di-fetch dengan query baru
- DOM di-update dengan hasil baru
- **TANPA PAGE RELOAD** ✅

### Filter Kategori
- User memilih kategori → `change` event triggered
- Category diubah → `loadCourses()` dipanggil
- API mengembalikan data yang sudah ter-filter
- Hasil ditampilkan di halaman
- **TANPA PAGE RELOAD** ✅

### Pagination
- Smart pagination dengan smart page numbers
- Current page highlighted
- Auto scroll to top saat ganti halaman
- Page info display (Halaman X dari Y)

### Loading State
- Spinner ditampilkan saat fetch data
- Spinner disembunyikan setelah data loaded
- User experience lebih baik

### Empty State
- Pesan "Tidak ada mata kuliah ditemukan" saat tidak ada hasil
- Membantu user memahami situasi

---

## Testing

### Test Real-time Search
```
1. Ketik "algoritma" di search bar
   → Hanya CS101 ditampilkan (filtered)

2. Ketik "Dr." di search bar
   → Semua mata kuliah diajar Dr. ditampilkan

3. Kosongkan search bar
   → Kembali ke semua mata kuliah
```

### Test Filter Kategori
```
1. Pilih "Wajib" → 9 mata kuliah wajib ditampilkan
2. Pilih "Peminatan" → 11 mata kuliah peminatan ditampilkan
3. Pilih "Semua Kategori" → 20 mata kuliah ditampilkan
```

### Test Pagination
```
1. Halaman 1 → 9 mata kuliah ditampilkan
2. Klik halaman 2 → 9 mata kuliah berikutnya ditampilkan
3. Klik halaman 3 → 2 mata kuliah terakhir ditampilkan
```

### Verify No Page Reload
- Semua aksi (search, filter, pagination) terjadi TANPA refresh halaman ✅
- Loading spinner muncul sebentar saat fetch
- DOM di-update secara smooth

---

## Teknologi Digunakan
- **Backend**: Laravel 11, PHP 8.3+
- **API**: RESTful JSON endpoints
- **Frontend**: Vanilla JavaScript (Fetch API)
- **CSS**: TailwindCSS 3 dengan green theme
- **Database**: SQLite3
- **ORM**: Eloquent

---

## File Structure
```
routes/api.php                                    → API endpoint
app/Http/Controllers/CourseController.php         → API logic
resources/views/courses/index.blade.php           → Frontend + JavaScript
database/seeders/CourseSeeder.php                 → 20 dummy data
```

---

**Status**: ✅ COMPLETE - Sesuai dengan instruksi exam
**Last Updated**: 28 Januari 2026
