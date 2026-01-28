<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Mata Kuliah - WHTECH</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
    @include('layouts.navbar')

    <div class="bg-green-500 text-white py-12">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl font-bold">Daftar Mata Kuliah</h1>
            <p>Daftar lengkap mata kuliah yang tersedia</p>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 py-10">

        <!-- FILTER SECTION -->
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
                    <input id="searchInput" type="text" placeholder="Cari berdasarkan nama, kode, atau dosen..."
                        class="w-full border-2 border-green-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
            </div>
        </div>

        <!-- LOADING SPINNER -->
        <div id="loading" class="text-center hidden py-12">
            <div class="inline-block">
                <div class="animate-spin rounded-full h-12 w-12 border-b-4 border-green-500"></div>
                <p class="text-gray-600 mt-4">Memuat data...</p>
            </div>
        </div>

        <!-- COURSES GRID -->
        <div id="coursesContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8"></div>

        <!-- EMPTY STATE -->
        <div id="emptyState" class="hidden text-center py-12 bg-white rounded-lg shadow-md">
            <p class="text-3xl mb-2">😔</p>
            <p class="text-xl font-medium text-gray-600">Tidak ada mata kuliah ditemukan</p>
            <p class="text-gray-500 mt-2">Coba ubah filter atau kata kunci pencarian</p>
        </div>

        <!-- PAGINATION -->
        <div id="paginationContainer" class="flex justify-center flex-wrap gap-2 mt-8 mb-8"></div>

        <!-- STATISTICS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
            <div class="bg-green-100 p-6 rounded-lg text-center border-t-4 border-green-500">
                <p class="text-4xl font-bold text-green-600" id="totalCount">0</p>
                <p class="text-gray-700 mt-2">Total Mata Kuliah</p>
            </div>
            <div class="bg-red-100 p-6 rounded-lg text-center border-t-4 border-red-500">
                <p class="text-4xl font-bold text-red-600" id="wajibCount">0</p>
                <p class="text-gray-700 mt-2">Mata Kuliah Wajib</p>
            </div>
            <div class="bg-blue-100 p-6 rounded-lg text-center border-t-4 border-blue-500">
                <p class="text-4xl font-bold text-blue-600" id="peminatanCount">0</p>
                <p class="text-gray-700 mt-2">Mata Kuliah Peminatan</p>
            </div>
        </div>

    </main>

    @include('layouts.footer')

    <script>
    document.addEventListener('DOMContentLoaded', function() {

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
            console.log("Fetch URL:", url);

            try {
                const res = await fetch(url);
                const result = await res.json();
                console.log("API Response:", result);

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

        function renderPagination(pagination) {
            if (pagination.last_page <= 1) return;

            let html = "";

            if (pagination.current_page > 1) {
                html +=
                    `<button onclick="goToPage(${pagination.current_page - 1})" class="px-3 py-2 bg-green-500 text-white rounded hover:bg-green-600">← Sebelumnya</button>`;
            }

            for (let i = 1; i <= pagination.last_page; i++) {
                if (i === pagination.current_page) {
                    html += `<button class="px-3 py-2 bg-green-600 text-white rounded font-bold">${i}</button>`;
                } else {
                    html +=
                        `<button onclick="goToPage(${i})" class="px-3 py-2 bg-gray-200 rounded hover:bg-gray-300">${i}</button>`;
                }
            }

            if (pagination.current_page < pagination.last_page) {
                html +=
                    `<button onclick="goToPage(${pagination.current_page + 1})" class="px-3 py-2 bg-green-500 text-white rounded hover:bg-green-600">Berikutnya →</button>`;
            }

            paginationContainer.innerHTML = html;
        }

        async function updateStatistics() {
            try {
                const res = await fetch("/api/courses/search?per_page=1000");
                const result = await res.json();

                if (result.success && result.pagination) {
                    const total = result.pagination.total;

                    // Count from all data returned (up to 1000)
                    const allCourses = result.data || [];
                    const wajib = allCourses.filter(c => c.category === 'Wajib').length;
                    const peminatan = allCourses.filter(c => c.category === 'Peminatan').length;

                    document.getElementById('totalCount').textContent = total;
                    document.getElementById('wajibCount').textContent = wajib;
                    document.getElementById('peminatanCount').textContent = peminatan;

                    console.log("Statistics updated: Total=" + total + ", Wajib=" + wajib + ", Peminatan=" +
                        peminatan);
                }
            } catch (e) {
                console.error("Error updating statistics:", e);
            }
        }

        window.goToPage = function(page) {
            currentPage = page;
            loadCourses(page);
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        categoryFilter.addEventListener('change', e => {
            currentCategory = e.target.value;
            currentPage = 1;
            loadCourses();
        });

        searchInput.addEventListener('keyup', e => {
            currentQuery = e.target.value;
            currentPage = 1;
            loadCourses();
        });

        // LOAD DATA SAAT HALAMAN PERTAMA KALI DIBUKA
        loadCourses();
    });
    </script>

</body>

</html>