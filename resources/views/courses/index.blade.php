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
    <div class="bg-gradient-to-r from-green-400 to-green-500 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-3">Daftar Mata Kuliah</h1>
            <p class="text-green-50 text-sm sm:text-base">Daftar lengkap mata kuliah yang tersedia di program studi kami
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <!-- Filter Section -->
        <div
            class="mb-8 md:mb-12 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-6 md:p-8 border-t-4 border-green-500">
            <h2 class="text-lg md:text-xl font-semibold text-gray-900 mb-6">Filter & Pencarian</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Filter Kategori</label>
                    <select id="categoryFilter"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 hover:border-green-300 bg-white cursor-pointer">
                        <option value="">Semua Kategori</option>
                        <option value="Wajib">Wajib</option>
                        <option value="Peminatan">Peminatan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Cari Mata Kuliah</label>
                    <input type="text" id="searchInput" placeholder="Cari berdasarkan nama, kode, atau dosen..."
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 hover:border-green-300">
                </div>
            </div>
        </div>

        <!-- Loading Indicator -->
        <div id="loadingIndicator" class="hidden">
            <div class="flex justify-center items-center py-12">
                <div class="text-center">
                    <div class="inline-block">
                        <div class="animate-spin rounded-full h-12 w-12 border-b-4 border-green-500"></div>
                    </div>
                    <p class="text-gray-600 mt-4 font-medium">Memuat data...</p>
                </div>
            </div>
        </div>

        <!-- Courses Grid -->
        <div id="coursesContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            <!-- Courses akan dimuat dari API -->
        </div>

        <!-- Empty State -->
        <div id="emptyState" class="hidden">
            <div class="bg-white rounded-lg shadow-md p-12 md:p-16 text-center">
                <p class="text-gray-500 text-lg md:text-xl font-medium">😔 Tidak ada mata kuliah yang ditemukan</p>
                <p class="text-gray-400 mt-2">Coba ubah filter atau kata kunci pencarian</p>
            </div>
        </div>

        <!-- Pagination -->
        <div id="paginationContainer" class="mt-12 md:mt-16 flex flex-wrap justify-center items-center gap-3">
            <!-- Pagination buttons akan dimuat dari API -->
        </div>

        <!-- Statistics -->
        <div class="mt-16 md:mt-20 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            <div
                class="bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 p-6 md:p-8 text-center border-t-4 border-green-500 transform hover:scale-105">
                <p class="text-4xl md:text-5xl font-bold text-green-600 mb-2" id="totalCount">0</p>
                <p class="text-gray-600 text-sm md:text-base font-medium">Total Mata Kuliah</p>
            </div>
            <div
                class="bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 p-6 md:p-8 text-center border-t-4 border-red-400 transform hover:scale-105">
                <p class="text-4xl md:text-5xl font-bold text-red-500 mb-2" id="wajibCount">0</p>
                <p class="text-gray-600 text-sm md:text-base font-medium">Mata Kuliah Wajib</p>
            </div>
            <div
                class="bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 p-6 md:p-8 text-center border-t-4 border-emerald-500 transform hover:scale-105">
                <p class="text-4xl md:text-5xl font-bold text-emerald-600 mb-2" id="peminatanCount">0</p>
                <p class="text-gray-600 text-sm md:text-base font-medium">Mata Kuliah Peminatan</p>
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
        coursesContainer.innerHTML = courses.map((course, index) => `
            <div class="group bg-white rounded-lg shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-green-200 transform hover:-translate-y-1" style="animation-delay: ${index * 50}ms;">
                <div class="relative bg-gradient-to-r from-green-400 to-green-500 px-6 py-6 overflow-hidden">
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-10 bg-white transition-opacity duration-300"></div>
                    <div class="relative flex justify-between items-start z-10">
                        <div>
                            <p class="text-green-100 text-sm font-bold tracking-wider">${course.course_code}</p>
                            <h3 class="text-white text-lg font-bold mt-2 group-hover:text-green-50 transition-colors duration-200 line-clamp-2">${course.name}</h3>
                        </div>
                        <span class="inline-block bg-white px-4 py-1 rounded-full text-xs font-bold text-green-600 whitespace-nowrap ml-2 transform group-hover:scale-110 transition-transform duration-200">
                            ${course.category === 'Wajib' ? '✓ Wajib' : '★ Peminatan'}
                        </span>
                    </div>
                </div>
                <div class="px-6 py-6 space-y-4">
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3 p-3 rounded-lg bg-gray-50 group-hover:bg-green-50 transition-colors duration-200">
                            <span class="text-xl">📚</span>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">SKS (Kredit)</p>
                                <p class="text-xl font-bold text-gray-900">${course.sks} SKS</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3 p-3 rounded-lg bg-gray-50 group-hover:bg-green-50 transition-colors duration-200">
                            <span class="text-xl">👨‍🏫</span>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide">Dosen Pengampu</p>
                                <p class="text-sm font-semibold text-gray-900 line-clamp-1">${course.lecturer}</p>
                            </div>
                        </div>
                    </div>
                    <div class="border-t-2 border-gray-100 group-hover:border-green-200 transition-colors duration-200 pt-4">
                        <p class="text-sm text-gray-600 leading-relaxed line-clamp-3 group-hover:text-gray-700 transition-colors duration-200">${course.description}</p>
                    </div>
                    <div>
                        ${course.category === 'Wajib'
                    ? '<span class="inline-block bg-red-100 text-red-800 text-xs font-bold px-3 py-2 rounded-lg">Wajib Diambil</span>'
                    : '<span class="inline-block bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-2 rounded-lg">Mata Kuliah Peminatan</span>'
                }
                    </div>
                </div>
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-t-2 border-gray-100 group-hover:bg-gradient-to-r group-hover:from-green-50 group-hover:to-white transition-all duration-200">
                    <a href="#" class="inline-flex items-center text-green-600 hover:text-green-700 font-bold text-sm group/link transition-colors duration-200">
                        <span>Lihat Detail Lengkap</span>
                        <span class="ml-2 group-hover/link:translate-x-1 transition-transform duration-200">→</span>
                    </a>
                </div>
            </div>
        `).join('');

        // Tambahkan animasi fade-in
        const cards = coursesContainer.querySelectorAll('[style*="animation-delay"]');
        cards.forEach(card => {
            card.style.opacity = '0';
            card.style.animation = 'fadeInUp 0.5s ease-out forwards';
        });
    }

    function renderPagination(pagination) {
        const {
            current_page,
            last_page
        } = pagination;

        if (last_page <= 1) return;

        let html = '';

        // Previous Button
        if (current_page > 1) {
            html += `
                <button onclick="goToPage(${current_page - 1})" 
                    class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 active:bg-green-700 transition-all duration-200 font-semibold text-sm whitespace-nowrap transform hover:scale-105 active:scale-95">
                    ← Sebelumnya
                </button>`;
        }

        // Page Numbers
        for (let i = 1; i <= last_page; i++) {
            if (i === current_page) {
                html +=
                    `<span class="px-4 py-2 bg-green-600 text-white rounded-lg font-bold text-sm min-w-[2.5rem] text-center">${i}</span>`;
            } else if (i === 1 || i === last_page || (i >= current_page - 1 && i <= current_page + 1)) {
                html += `
                    <button onclick="goToPage(${i})" 
                        class="px-4 py-2 bg-white border-2 border-green-300 text-green-600 rounded-lg hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 active:bg-green-100 transition-all duration-200 font-semibold text-sm min-w-[2.5rem] transform hover:scale-105 active:scale-95">
                        ${i}
                    </button>`;
            } else if (i === current_page - 2 || i === current_page + 2) {
                html += `<span class="px-2 text-gray-500">...</span>`;
            }
        }

        // Next Button
        if (current_page < last_page) {
            html += `
                <button onclick="goToPage(${current_page + 1})" 
                    class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 active:bg-green-700 transition-all duration-200 font-semibold text-sm whitespace-nowrap transform hover:scale-105 active:scale-95">
                    Berikutnya →
                </button>`;
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

                animateNumber('totalCount', total);
                animateNumber('wajibCount', wajib);
                animateNumber('peminatanCount', peminatan);
            }
        } catch (error) {
            console.error('Error updating statistics:', error);
        }
    }

    function animateNumber(elementId, finalValue) {
        const element = document.getElementById(elementId);
        const currentValue = parseInt(element.textContent) || 0;
        const increment = Math.ceil((finalValue - currentValue) / 20);
        let count = currentValue;

        const interval = setInterval(() => {
            count += increment;
            if (count >= finalValue) {
                count = finalValue;
                clearInterval(interval);
            }
            element.textContent = count;
        }, 20);
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

    // Add CSS animation for fade-in
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    `;
    document.head.appendChild(style);

    // Load courses on page load
    loadCourses();
    </script>
</body>

</html>