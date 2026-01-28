<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Daftar Mata Kuliah - WHTECH</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50">
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Page Header -->
    <div class="bg-gradient-to-r from-green-400 to-green-500 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold mb-2">Daftar Mata Kuliah</h1>
            <p class="text-green-50">Daftar lengkap mata kuliah yang tersedia di program studi kami</p>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Filter Section -->
        <div class="mb-8 bg-white rounded-lg shadow p-6 border-t-4 border-green-500">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Filter Kategori</label>
                    <select id="categoryFilter"
                        class="w-full px-3 py-2 border border-green-200 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                        <option value="">Semua Kategori</option>
                        <option value="Wajib">Wajib</option>
                        <option value="Peminatan">Peminatan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari Mata Kuliah</label>
                    <input type="text" id="searchInput" placeholder="Cari berdasarkan nama atau kode..."
                        class="w-full px-3 py-2 border border-green-200 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                </div>
            </div>
        </div>

        <!-- Loading Indicator -->
        <div id="loadingIndicator" class="hidden text-center py-8">
            <div class="inline-block">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-green-500"></div>
                <p class="text-gray-600 mt-2">Memuat data...</p>
            </div>
        </div>

        <!-- Courses Grid -->
        <div id="coursesContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Courses akan dimuat dari API -->
        </div>

        <!-- Empty State -->
        <div id="emptyState" class="hidden">
            <div class="bg-white rounded-lg shadow p-12 text-center">
                <p class="text-gray-500 text-lg">😔 Tidak ada mata kuliah yang ditemukan</p>
            </div>
        </div>

        <!-- Pagination -->
        <div id="paginationContainer" class="mt-8 flex justify-center items-center space-x-2">
            <!-- Pagination buttons akan dimuat dari API -->
        </div>

        <!-- Statistics -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white rounded-lg shadow p-6 text-center border-t-4 border-green-500">
                <p class="text-3xl font-bold text-green-600" id="totalCount">0</p>
                <p class="text-gray-600 mt-2">Total Mata Kuliah</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center border-t-4 border-red-400">
                <p class="text-3xl font-bold text-red-500" id="wajibCount">0</p>
                <p class="text-gray-600 mt-2">Mata Kuliah Wajib</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center border-t-4 border-emerald-500">
                <p class="text-3xl font-bold text-emerald-600" id="peminatanCount">0</p>
                <p class="text-gray-600 mt-2">Mata Kuliah Peminatan</p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Script untuk Fetch API dan Filtering -->
    <script>
    const API_URL = '/api/courses/search';
    let currentPage = 1;
    let currentQuery = '';
    let currentCategory = '';

    const categoryFilter = document.getElementById('categoryFilter');
    const searchInput = document.getElementById('searchInput');
    const coursesContainer = document.getElementById('coursesContainer');
    const emptyState = document.getElementById('emptyState');
    const loadingIndicator = document.getElementById('loadingIndicator');
    const paginationContainer = document.getElementById('paginationContainer');

    async function loadCourses(page = 1, search = '', category = '') {
        try {
            loadingIndicator.classList.remove('hidden');
            coursesContainer.innerHTML = '';
            emptyState.classList.add('hidden');
            paginationContainer.innerHTML = '';

            const params = new URLSearchParams({
                q: search,
                category: category,
                page: page,
                per_page: 9,
            });

            const response = await fetch(`${API_URL}?${params.toString()}`);
            const result = await response.json();

            loadingIndicator.classList.add('hidden');

            if (result.success && result.data.length > 0) {
                renderCourses(result.data);
                renderPagination(result.pagination);
                updateStatistics();
            } else {
                emptyState.classList.remove('hidden');
            }
        } catch (error) {
            console.error('Error loading courses:', error);
            loadingIndicator.classList.add('hidden');
            emptyState.classList.remove('hidden');
        }
    }

    function renderCourses(courses) {
        coursesContainer.innerHTML = courses.map(course => `
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden">
                    <div class="bg-gradient-to-r from-green-400 to-green-500 px-6 py-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-green-50 text-sm font-medium">${course.course_code}</p>
                                <h3 class="text-white text-lg font-bold mt-1">${course.name}</h3>
                            </div>
                            <span class="inline-block bg-white px-3 py-1 rounded-full text-xs font-semibold text-green-600">
                                ${course.category}
                            </span>
                        </div>
                    </div>
                    <div class="px-6 py-4">
                        <div class="space-y-3 mb-4">
                            <div class="flex items-center">
                                <span class="text-2xl mr-3">📚</span>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">SKS (Kredit)</p>
                                    <p class="text-lg font-semibold text-gray-900">${course.sks}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <span class="text-2xl mr-3">👨‍🏫</span>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">Dosen Pengampu</p>
                                    <p class="text-sm font-medium text-gray-900">${course.lecturer}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 border-t border-green-100 pt-4">
                            <p class="text-sm text-gray-600 line-clamp-3">${course.description}</p>
                        </div>
                        ${course.category === 'Wajib' 
                            ? '<div class="inline-block bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded">Mata Kuliah Wajib</div>'
                            : '<div class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded">Mata Kuliah Peminatan</div>'
                        }
                    </div>
                    <div class="px-6 py-3 bg-gray-50 border-t border-green-100 hover:bg-green-50 transition">
                        <a href="#" class="text-green-600 hover:text-green-800 font-semibold text-sm inline-flex items-center">
                            Lihat Detail
                            <span class="ml-2">→</span>
                        </a>
                    </div>
                </div>
            `).join('');
    }

    function renderPagination(pagination) {
        const {
            current_page,
            last_page
        } = pagination;

        if (last_page <= 1) return;

        let html = '';

        if (current_page > 1) {
            html +=
                `<button onclick="goToPage(${current_page - 1})" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition">← Sebelumnya</button>`;
        }

        for (let i = 1; i <= last_page; i++) {
            if (i === current_page) {
                html += `<span class="px-4 py-2 bg-green-600 text-white rounded-md font-semibold">${i}</span>`;
            } else if (i === 1 || i === last_page || (i >= current_page - 1 && i <= current_page + 1)) {
                html +=
                    `<button onclick="goToPage(${i})" class="px-4 py-2 bg-white border-2 border-green-300 text-green-600 rounded-md hover:bg-green-50 transition">${i}</button>`;
            } else if (i === current_page - 2 || i === current_page + 2) {
                html += `<span class="px-2">...</span>`;
            }
        }

        if (current_page < last_page) {
            html +=
                `<button onclick="goToPage(${current_page + 1})" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition">Berikutnya →</button>`;
        }

        paginationContainer.innerHTML = html;
    }

    function goToPage(page) {
        currentPage = page;
        loadCourses(page, currentQuery, currentCategory);
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    async function updateStatistics() {
        try {
            const response = await fetch('/api/courses');
            const result = await response.json();

            if (result.success) {
                const allCourses = result.data;
                const total = result.pagination.total;
                const wajib = allCourses.filter(c => c.category === 'Wajib').length;
                const peminatan = allCourses.filter(c => c.category === 'Peminatan').length;

                document.getElementById('totalCount').textContent = total;
                document.getElementById('wajibCount').textContent = wajib;
                document.getElementById('peminatanCount').textContent = peminatan;
            }
        } catch (error) {
            console.error('Error updating statistics:', error);
        }
    }

    categoryFilter.addEventListener('change', (e) => {
        currentCategory = e.target.value;
        currentPage = 1;
        loadCourses(1, currentQuery, currentCategory);
    });

    searchInput.addEventListener('keyup', (e) => {
        currentQuery = e.target.value;
        currentPage = 1;
        loadCourses(1, currentQuery, currentCategory);
    });

    loadCourses();
    </script>
</body>

</html>