<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Mata Kuliah - WHTECH</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
    /* ================= BUTTON ANIMATIONS ================= */
    button,
    a.button-like {
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    button:hover,
    a.button-like:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    button:active,
    a.button-like:active {
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    button:focus,
    a.button-like:focus {
        outline: 2px solid #16a34a;
        outline-offset: 2px;
    }

    /* ================= TABLE ================= */
    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 8px;
    }

    th {
        background: linear-gradient(135deg, #16a34a, #15803d);
        color: white;
        padding: 16px 18px;
        text-align: left;
        font-weight: 700;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
    }

    td {
        padding: 16px 18px;
        background: white;
        border-bottom: none;
        font-size: 0.95rem;
    }

    tbody tr {
        transition: all 0.2s ease;
        border-radius: 8px;
    }

    tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(22, 163, 74, 0.15);
    }

    tbody tr:hover td {
        background-color: #f0fdf4;
    }

    /* ================= BADGE ================= */
    .course-code {
        background: linear-gradient(135deg, #dcfce7, #d1fae5);
        color: #166534;
        padding: 8px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.85rem;
        letter-spacing: 0.3px;
        display: inline-block;
    }

    .category-wajib {
        background: linear-gradient(135deg, #fee2e2, #fecaca);
        color: #991b1b;
        padding: 8px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-block;
    }

    .category-peminatan {
        background: linear-gradient(135deg, #dcfce7, #d1fae5);
        color: #166534;
        padding: 8px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-block;
    }

    /* ================= SPACING ================= */
    .hero-section {
        padding: 16px 0;
    }

    .search-section {
        margin-bottom: 24px;
    }

    .table-wrapper {
        padding-top: 24px;
    }

    /* ================= STAT CARDS ================= */
    .stat-card {
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(22, 163, 74, 0.2);
    }
    </style>
</head>

<body class="bg-gray-50">

    {{-- NAVBAR --}}
    @include('layouts.navbar')

    <!-- HERO -->
    <section class="bg-gradient-to-r from-green-600 to-green-500 text-white hero-section">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-4xl font-bold mb-3">Daftar Mata Kuliah</h1>
            <p class="text-green-100 max-w-2xl">
                Daftar lengkap mata kuliah yang tersedia di program studi Mini Portal akademik Kampus
            </p>
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-6 py-8">

        <div class="container-card bg-transparent space-y-12">

            <!-- Intro / Container -->
            <div class="bg-white/0 px-4 py-6 rounded-md">
                <p class="text-green-700 font-medium">Selamat datang di Mini Portal akademik Kampus — berikut daftar
                    mata kuliah yang tersedia. Gunakan kotak pencarian untuk memfilter berdasarkan nama, kode, atau
                    dosen.</p>
            </div>

            <!-- TABLE CARD -->
            <section class="bg-white rounded-xl shadow-lg border border-green-200 overflow-hidden">

                <div class="p-8 bg-gradient-to-r from-green-50 to-white border-b border-green-200 space-y-6">
                    <h2 class="text-2xl font-bold text-green-700">
                        Daftar Mata Kuliah
                        <span class="text-green-500 text-lg font-semibold">(15)</span>
                    </h2>

                    <!-- SEARCH -->
                    <div class="search-section">
                        <input id="liveSearch" type="text" placeholder="🔍 Cari nama, kode, atau dosen..." class="w-full px-5 py-3 border-2 border-green-200 rounded-lg
                               focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:outline-none
                               transition duration-300 font-medium" />
                    </div>
                </div>

                <div class="table-wrapper overflow-x-auto px-8 pb-8">
                    <table id="coursesTable">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 12%;">Kode</th>
                                <th style="width: 28%;">Mata Kuliah</th>
                                <th style="width: 25%;">Dosen</th>
                                <th style="width: 10%;">SKS</th>
                                <th style="width: 20%;">Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DATA DINAMIS DARI DATABASE -->
                            @forelse($courses ?? [] as $index => $course)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><span class="course-code">{{ $course->course_code }}</span></td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->lecturer }}</td>
                                <td class="text-center font-semibold">{{ $course->sks }}</td>
                                <td>
                                    @if($course->category === 'Wajib')
                                    <span class="category-wajib">Wajib</span>
                                    @else
                                    <span class="category-peminatan">Peminatan</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <!-- FALLBACK DATA DUMMY -->
                            <tr>
                                <td>1</td>
                                <td><span class="course-code">CS101</span></td>
                                <td>Algoritma & Pemrograman</td>
                                <td>Dr. Budi Santoso</td>
                                <td class="text-center">3</td>
                                <td><span class="category-wajib">Wajib</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><span class="course-code">CS102</span></td>
                                <td>Struktur Data</td>
                                <td>Prof. Siti Nurhaliza</td>
                                <td class="text-center">3</td>
                                <td><span class="category-wajib">Wajib</span></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><span class="course-code">CS103</span></td>
                                <td>Database Management System</td>
                                <td>Dr. Ahmad Wijaya</td>
                                <td class="text-center">3</td>
                                <td><span class="category-wajib">Wajib</span></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><span class="course-code">CS109</span></td>
                                <td>Data Mining</td>
                                <td>Dr. Ahmad Husain</td>
                                <td class="text-center">3</td>
                                <td><span class="category-wajib">Wajib</span></td>
                            </tr>

                            <tr>
                                <td>5</td>
                                <td><span class="course-code">CS109</span></td>
                                <td>Data Mining</td>
                                <td>Dr. Ahmad Husain</td>
                                <td class="text-center">3</td>
                                <td><span class="category-wajib">Wajib</span></td>
                            </tr>

                            <tr>
                                <td>6</td>
                                <td><span class="course-code">CS100</span></td>
                                <td>Sistem Operasi</td>
                                <td>Dr. Husain Hasan</td>
                                <td class="text-center">3</td>
                                <td><span class="category-wajib">Peminatan</span></td>
                            </tr>

                            <tr>
                                <td>7</td>
                                <td><span class="course-code">CS190</span></td>
                                <td>Kerja Praktek</td>
                                <td>Dr. Lisa NUr</td>
                                <td class="text-center">3</td>
                                <td><span class="category-wajib">Wajib</span></td>
                            </tr>
                            <tr></tr>
                            <td>8</td>
                            <td><span class="course-code">CS201</span></td>
                            <td>Jaringan Komputer</td>
                            <td>Dr. Lina Marlina</td>
                            <td class="text-center">3</td>
                            <td><span class="category-peminatan">Peminatan</span></td>
                            </tr>


                            <tr>
                                <td>9</td>
                                <td><span class="course-code">CS202</span></td>
                                <td>Algoritma</td>
                                <td>Dr. Anwar</td>
                                <td class="text-center">3</td>
                                <td><span class="category-wajib">Wajib</span></td>
                            </tr>


                            <tr>
                                <td>10</td>
                                <td><span class="course-code">CS208</span></td>
                                <td>Aljabar</td>
                                <td>Nita Zahra S.Kom</td>
                                <td class="text-center">3</td>
                                <td><span class="category-wajib">Wajib</span></td>
                            </tr>

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- STATISTIC CARDS -->
            <section class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="bg-white p-8 rounded-xl border-2 border-green-200 shadow-lg stat-card">
                    <p id="totalCount" class="text-5xl font-bold text-green-600 mb-3">15</p>
                    <p class="text-green-700 font-semibold text-lg">Total Mata Kuliah</p>
                </div>

                <div class="bg-white p-8 rounded-xl border-2 border-red-200 shadow-lg stat-card">
                    <p id="wajibCount" class="text-5xl font-bold text-red-600 mb-3">7</p>
                    <p class="text-gray-700 font-semibold text-lg">Mata Kuliah Wajib</p>
                </div>

                <div class="bg-white p-8 rounded-xl border-2 border-green-200 shadow-lg stat-card">
                    <p id="peminatanCount" class="text-5xl font-bold text-green-600 mb-3">8</p>
                    <p class="text-gray-700 font-semibold text-lg">Mata Kuliah Peminatan</p>
                </div>

            </section>

        </div>

    </main>

    {{-- FOOTER --}}
    @include('layouts.footer')

    <!-- SCRIPT -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('liveSearch');
        const table = document.getElementById('coursesTable');
        const tbody = table.tBodies[0];

        const totalEl = document.getElementById('totalCount');
        const wajibEl = document.getElementById('wajibCount');
        const peminatanEl = document.getElementById('peminatanCount');

        function updateCounts() {
            const rows = [...tbody.rows].filter(r => r.style.display !== 'none');
            totalEl.textContent = rows.length;

            wajibEl.textContent = rows.filter(r =>
                r.textContent.toLowerCase().includes('wajib')
            ).length;

            peminatanEl.textContent = rows.filter(r =>
                r.textContent.toLowerCase().includes('peminatan')
            ).length;
        }

        input.addEventListener('input', e => {
            const q = e.target.value.toLowerCase();
            [...tbody.rows].forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
            });
            updateCounts();
        });

        updateCounts();
    });
    </script>

</body>

</html>