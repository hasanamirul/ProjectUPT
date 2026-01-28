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
        font-size: 0.95rem;
    }

    tbody tr {
        transition: all 0.2s ease
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
        font-weight: 700;
        font-size: 0.85rem;
        letter-spacing: 0.3px;
        display: inline-block;
    }

    .category-wajib {
        background: linear-gradient(135deg, #fee2e2, #fecaca);
        color: #991b1b;
        padding: 8px 12px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-block;
    }

    .category-peminatan {
        background: linear-gradient(135deg, #dcfce7, #d1fae5);
        color: #166534;
        padding: 8px 12px;
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

    /* ================= RESPONSIVE DESIGN ================= */
    @media (max-width: 768px) {
        .hero-section {
            padding: 12px 0;
        }

        th,
        td {
            padding: 10px 12px;
            font-size: 0.90rem;
        }

        .course-code {
            padding: 6px 10px;
            font-size: 0.8rem;
        }

        .stat-card p {
            font-size: 1rem;
        }

        .table-wrapper {
            padding-top: 12px;
        }
    }
    </style>
</head>

<body class="bg-gray-50">

    {{-- NAVBAR --}}
    @include('layouts.navbar')


    <main class="max-w-7xl mx-auto px-6 py-8">

        <div class="container-card bg-transparent space-y-12">

            <!-- Intro / Container -->
            <div class="bg-white/0 px-4 py-6 rounded-md">
                <p class="text-green-700 font-medium">Selamat datang di Mini Portal akademik Kampus — berikut daftar
                    mata kuliah yang tersedia. Gunakan kotak pencarian untuk memfilter berdasarkan nama, kode, atau
                    dosen.</p>
            </div>

            <!-- TABLE CARD -->
            <section class="bg-white rounded-xl shadow-lg border-green-200 overflow-hidden">

                <div class="p-8 bg-gradient-to-r from-green-50 to-white border-green-200 space-y-6">
                    <h2 class="text-2xl font-bold text-green-700">
                        Daftar Mata Kuliah
                        <span class="text-green-500 text-lg font-semibold">(15)</span>
                    </h2>

                    <!-- SEARCH -->
                    <div class="search-section">
                        <input id="liveSearch" type="text" placeholder="🔍 Cari nama, kode, atau dosen..."
                            class="w-full px-5 py-3  border-green-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:outline-none transition duration-300 font-medium" />
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

                        <tbody id="coursesTbody">
                            @php
                            $present = collect($courses ?? []);
                            // prepare dummy TI-related courses
                            $dummyCourses = [
                            ['course_code' => 'TI101', 'name' => 'Pengantar Teknologi Informasi', 'sks' => 3, 'lecturer'
                            => 'Dr. Agus Prasetyo, M.Kom', 'category' => 'Wajib'],
                            ['course_code' => 'TI102', 'name' => 'Algoritma & Pemrograman', 'sks' => 3, 'lecturer' =>
                            'Prof. Dr. Siti Aminah, S.Kom, M.Sc', 'category' => 'Wajib'],
                            ['course_code' => 'TI103', 'name' => 'Struktur Data', 'sks' => 3, 'lecturer' => 'Dr. Budi
                            Santoso, M.Kom', 'category' => 'Wajib'],
                            ['course_code' => 'TI201', 'name' => 'Basis Data', 'sks' => 3, 'lecturer' => 'Ir. Rina
                            Cahyani, M.T', 'category' => 'Wajib'],
                            ['course_code' => 'TI202', 'name' => 'Sistem Operasi', 'sks' => 3, 'lecturer' => 'Dr. Hendra
                            Wijaya, S.Kom, M.Kom', 'category' => 'Wajib'],
                            ['course_code' => 'TI203', 'name' => 'Jaringan Komputer', 'sks' => 3, 'lecturer' => 'Ir.
                            Lina Marlina, M.T', 'category' => 'Peminatan'],
                            ['course_code' => 'TI204', 'name' => 'Keamanan Siber', 'sks' => 3, 'lecturer' => 'Dr. Yuni
                            Magdalena, S.Kom', 'category' => 'Peminatan'],
                            ['course_code' => 'TI301', 'name' => 'Rekayasa Perangkat Lunak', 'sks' => 4, 'lecturer' =>
                            'Prof. Maryoto Adi, M.Sc', 'category' => 'Wajib'],
                            ['course_code' => 'TI302', 'name' => 'Pengembangan Aplikasi Mobile', 'sks' => 3, 'lecturer'
                            => 'Dr. Haris Supriyanto, M.Kom', 'category' => 'Peminatan'],
                            ['course_code' => 'TI303', 'name' => 'Kecerdasan Buatan', 'sks' => 3, 'lecturer' => 'Prof.
                            Erwin Sutrisno, Ph.D', 'category' => 'Peminatan'],
                            ['course_code' => 'TI304', 'name' => 'Pemrograman Web Lanjut', 'sks' => 3, 'lecturer' =>
                            'Dr. Rina Cahyani, S.Kom', 'category' => 'Wajib'],
                            ['course_code' => 'TI305', 'name' => 'Analisis & Desain Sistem', 'sks' => 3, 'lecturer' =>
                            'Dr. Anita Kusuma, M.T', 'category' => 'Wajib'],
                            ['course_code' => 'TI306', 'name' => 'Big Data & Cloud Computing', 'sks' => 3, 'lecturer' =>
                            'Dr. Farah Azizah, M.Kom', 'category' => 'Peminatan'],
                            ['course_code' => 'TI307', 'name' => 'Internet of Things', 'sks' => 3, 'lecturer' => 'Ir.
                            Bambang Setiawan, M.Eng', 'category' => 'Peminatan'],
                            ['course_code' => 'TI308', 'name' => 'Interaksi Manusia dan Komputer', 'sks' => 3,
                            'lecturer' => 'Dr. Sinta Suryawati, M.Des', 'category' => 'Peminatan'],
                            ];

                            $rows = $present->take(15)->values()->toArray();
                            $needed = 15 - count($rows);
                            for ($i = 0; $i < $needed; $i++) { $rows[]=$dummyCourses[$i % count($dummyCourses)]; }
                                @endphp @foreach($rows as $index=> $course)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><span
                                            class="course-code">{{ $course['course_code'] ?? $course->course_code ?? '' }}</span>
                                    </td>
                                    <td>{{ $course['name'] ?? $course->name ?? '' }}</td>
                                    <td>{{ $course['lecturer'] ?? $course->lecturer ?? '' }}</td>
                                    <td class="text-center font-semibold">{{ $course['sks'] ?? $course->sks ?? '' }}
                                    </td>
                                    <td>
                                        @php $cat = $course['category'] ?? ($course->category ?? 'Peminatan'); @endphp
                                        @if($cat === 'Wajib')
                                        <span class="category-wajib">Wajib</span>
                                        @else
                                        <span class="category-peminatan">Peminatan</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>

                    <div id="pagination" class="mt-6 flex items-center justify-end gap-3 px-2"></div>
                </div>
            </section>

            <!-- STATISTIC CARDS -->
            <section class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="bg-white p-8 rounded-xl  border-green-200 shadow-lg stat-card">
                    <p id="totalCount" class="text-5xl font-bold text-green-600 mb-3">15</p>
                    <p class="text-green-700 font-semibold text-lg">Total Mata Kuliah</p>
                </div>

                <div class="bg-white p-8 rounded-xl  border-red-200 shadow-lg stat-card">
                    <p id="wajibCount" class="text-5xl font-bold text-red-600 mb-3">7</p>
                    <p class="text-gray-700 font-semibold text-lg">Mata Kuliah Wajib</p>
                </div>

                <div class="bg-white p-8 rounded-xl  border-green-200 shadow-lg stat-card">
                    <p id="peminatanCount" class="text-5xl font-bold text-green-600 mb-3">8</p>
                    <p class="text-gray-700 font-semibold text-lg">Mata Kuliah Peminatan</p>
                </div>

            </section>

        </div>

    </main>

    {{-- FOOTER --}}
    @include('layouts.footer')

    <!-- SCRIPT: Client-side filtering only; API removed -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('liveSearch');
        const tbody = document.getElementById('coursesTbody');
        const totalEl = document.getElementById('totalCount');
        const wajibEl = document.getElementById('wajibCount');
        const peminatanEl = document.getElementById('peminatanCount');

        // simpan HTML awal (15 data dari server)
        const initialHtml = tbody.innerHTML;

        function computeCountsFromVisibleRows() {
            const rows = Array.from(tbody.querySelectorAll('tr')).filter(r => r.style.display !== 'none' && r
                .querySelector('td'));
            const total = rows.length;
            let wajib = 0;
            rows.forEach(r => {
                if (r.textContent.toLowerCase().includes('wajib')) wajib++;
            });
            return {
                total,
                wajib,
                pem: total - wajib
            };
        }

        function updateCounts(obj) {
            totalEl.textContent = obj.total;
            wajibEl.textContent = obj.wajib;
            peminatanEl.textContent = obj.pem;
        }

        // initial counts
        updateCounts(computeCountsFromVisibleRows());

        function filterTable(q) {
            const term = q.trim().toLowerCase();
            const rows = Array.from(tbody.querySelectorAll('tr')).filter(r => r.querySelector('td'));
            if (!term) {
                rows.forEach(r => r.style.display = '');
            } else {
                rows.forEach(r => {
                    const text = r.textContent.toLowerCase();
                    r.style.display = text.includes(term) ? '' : 'none';
                });
            }
            updateCounts(computeCountsFromVisibleRows());
        }

        let debounceTimer = null;
        input.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                const q = input.value;
                filterTable(q);
            }, 150);
        });
    });
    </script>

</body>

</html>