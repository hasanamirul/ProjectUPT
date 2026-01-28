<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'course_code' => 'CS101',
                'name' => 'Algoritma & Pemrograman',
                'sks' => 3,
                'lecturer' => 'Dr. Budi Santoso',
                'description' => 'Mata kuliah pengenalan dasar algoritma, pseudocode, flowchart, dan konsep pemrograman dengan bahasa C.',
                'category' => 'Wajib',
            ],
            [
                'course_code' => 'CS102',
                'name' => 'Struktur Data',
                'sks' => 3,
                'lecturer' => 'Prof. Siti Nurhaliza',
                'description' => 'Mempelajari struktur data fundamental seperti array, linked list, stack, queue, tree, dan graph.',
                'category' => 'Wajib',
            ],
            [
                'course_code' => 'CS103',
                'name' => 'Database Management System',
                'sks' => 3,
                'lecturer' => 'Dr. Ahmad Wijaya',
                'description' => 'Pengenalan basis data relasional, SQL, normalisasi, dan desain database.',
                'category' => 'Wajib',
            ],
            [
                'course_code' => 'CS104',
                'name' => 'Web Development',
                'sks' => 4,
                'lecturer' => 'Ir. Rina Cahyani',
                'description' => 'Pembelajaran HTML, CSS, JavaScript, dan framework web modern untuk pengembangan aplikasi web.',
                'category' => 'Wajib',
            ],
            [
                'course_code' => 'CS105',
                'name' => 'Network & Communication',
                'sks' => 3,
                'lecturer' => 'Dr. Rudi Hermawan',
                'description' => 'Pengenalan jaringan komputer, protokol TCP/IP, routing, dan keamanan jaringan dasar.',
                'category' => 'Wajib',
            ],
            [
                'course_code' => 'CS106',
                'name' => 'Sistem Operasi',
                'sks' => 3,
                'lecturer' => 'Prof. Joko Suharyo',
                'description' => 'Konsep sistem operasi, process management, memory management, file system, dan security.',
                'category' => 'Wajib',
            ],
            [
                'course_code' => 'CS107',
                'name' => 'Teori Kompiler',
                'sks' => 3,
                'lecturer' => 'Dr. Wahyu Purnomo',
                'description' => 'Lexical analysis, syntax analysis, semantic analysis, code generation, dan optimization.',
                'category' => 'Wajib',
            ],
            [
                'course_code' => 'CS201',
                'name' => 'Mobile Development',
                'sks' => 4,
                'lecturer' => 'Dr. Haris Supriyanto',
                'description' => 'Pengembangan aplikasi mobile native dan cross-platform menggunakan framework terkini.',
                'category' => 'Peminatan',
            ],
            [
                'course_code' => 'CS202',
                'name' => 'Machine Learning',
                'sks' => 3,
                'lecturer' => 'Prof. Erwin Sutrisno',
                'description' => 'Dasar-dasar machine learning, supervised learning, unsupervised learning, dan neural networks.',
                'category' => 'Peminatan',
            ],
            [
                'course_code' => 'CS203',
                'name' => 'Cloud Computing',
                'sks' => 3,
                'lecturer' => 'Dr. Yuni Magdalena',
                'description' => 'Pengenalan arsitektur cloud, deployment, dan penggunaan layanan cloud computing komersial.',
                'category' => 'Peminatan',
            ],
            [
                'course_code' => 'CS204',
                'name' => 'Cybersecurity',
                'sks' => 3,
                'lecturer' => 'Ir. Tri Wahyono',
                'description' => 'Pengenalan keamanan siber, enkripsi, penetration testing, dan best practices keamanan informasi.',
                'category' => 'Peminatan',
            ],
            [
                'course_code' => 'CS205',
                'name' => 'IoT & Embedded Systems',
                'sks' => 3,
                'lecturer' => 'Dr. Bambang Setiawan',
                'description' => 'Pengembangan sistem tertanam, IoT architecture, sensor integration, dan real-time systems.',
                'category' => 'Peminatan',
            ],
            [
                'course_code' => 'CS206',
                'name' => 'Computer Vision',
                'sks' => 3,
                'lecturer' => 'Dr. Sinta Suryawati',
                'description' => 'Image processing, feature detection, object recognition, dan aplikasi computer vision modern.',
                'category' => 'Peminatan',
            ],
            [
                'course_code' => 'IT101',
                'name' => 'Pemrograman Object Oriented',
                'sks' => 3,
                'lecturer' => 'Prof. Maryoto Adi',
                'description' => 'Konsep object oriented programming, inheritance, polymorphism, encapsulation dengan bahasa Java.',
                'category' => 'Wajib',
            ],
            [
                'course_code' => 'IT102',
                'name' => 'Software Engineering',
                'sks' => 4,
                'lecturer' => 'Dr. Lies Sunaryo',
                'description' => 'Metodologi pengembangan software, SDLC, UML, testing, dan quality assurance.',
                'category' => 'Wajib',
            ],
            // Tambahan 15 data dummy
            [
                'course_code' => 'IT103',
                'name' => 'User Experience Design',
                'sks' => 3,
                'lecturer' => 'Dr. Anita Kusuma',
                'description' => 'Desain pengalaman pengguna, prototyping, dan usability testing.',
                'category' => 'Peminatan',
            ],
            [
                'course_code' => 'IT104',
                'name' => 'Multimedia & Animasi',
                'sks' => 3,
                'lecturer' => 'Ir. Dita Ramadhani',
                'description' => 'Produksi multimedia, animasi 2D/3D, dan editing video.',
                'category' => 'Peminatan',
            ],
            [
                'course_code' => 'IT105',
                'name' => 'Pemrograman Python Lanjut',
                'sks' => 3,
                'lecturer' => 'Prof. Hendra Wijaya',
                'description' => 'Keterampilan lanjutan Python untuk aplikasi data dan web.',
                'category' => 'Wajib',
            ],
            [
                'course_code' => 'CS301',
                'name' => 'Advanced Algorithms',
                'sks' => 3,
                'lecturer' => 'Dr. Faisal Rahman',
                'description' => 'Analisis kompleksitas, algoritma greedy, dynamic programming, dan graf berat.',
                'category' => 'Peminatan',
            ],
            [
                'course_code' => 'CS302',
                'name' => 'Parallel & Distributed Systems',
                'sks' => 3,
                'lecturer' => 'Dr. Sari Nugroho',
                'description' => 'Konsep komputasi paralel, MPI, dan arsitektur terdistribusi.',
                'category' => 'Peminatan',
            ],
            [
                'course_code' => 'CS303',
                'name' => 'Kecerdasan Buatan Terapan',
                'sks' => 3,
                'lecturer' => 'Prof. Rika Lestari',
                'description' => 'Aplikasi AI pada domain riil: NLP, rekomendasi, dan vision.',
                'category' => 'Peminatan',
            ],
            [
                'course_code' => 'CS304',
                'name' => 'Game Development',
                'sks' => 3,
                'lecturer' => 'Ir. Bima Prasetya',
                'description' => 'Perancangan dan pengembangan game menggunakan engine modern.',
                'category' => 'Peminatan',
            ],
            [
                'course_code' => 'IT201',
                'name' => 'Big Data Processing',
                'sks' => 3,
                'lecturer' => 'Dr. Farah Azizah',
                'description' => 'Teknik pemrosesan data besar menggunakan Spark dan ekosistemnya.',
                'category' => 'Peminatan',
            ],
            [
                'course_code' => 'IT202',
                'name' => 'Sistem Informasi Geografis',
                'sks' => 2,
                'lecturer' => 'Dr. Agus Pramono',
                'description' => 'Pengolahan data spasial dan pemanfaatannya dalam aplikasi praktis.',
                'category' => 'Peminatan',
            ],
            [
                'course_code' => 'IT203',
                'name' => 'Performance Engineering',
                'sks' => 2,
                'lecturer' => 'Prof. Wulan Sari',
                'description' => 'Optimasi kinerja aplikasi dan pemantauan performa produksi.',
                'category' => 'Wajib',
            ],
            [
                'course_code' => 'CS305',
                'name' => 'Natural Language Processing',
                'sks' => 3,
                'lecturer' => 'Dr. Dwi Haryanto',
                'description' => 'Pemrosesan bahasa alami, tokenisasi, dan model bahasa.',
                'category' => 'Peminatan',
            ],
            [
                'course_code' => 'CS306',
                'name' => 'Robotics Fundamentals',
                'sks' => 3,
                'lecturer' => 'Ir. Novi Kartika',
                'description' => 'Dasar-dasar robotika, kontrol, dan sensor integrasi.',
                'category' => 'Peminatan',
            ],
            [
                'course_code' => 'IT204',
                'name' => 'Cloud Security',
                'sks' => 3,
                'lecturer' => 'Dr. Yulianto',
                'description' => 'Prinsip keamanan di lingkungan cloud dan best practices.',
                'category' => 'Peminatan',
            ],
            [
                'course_code' => 'IT205',
                'name' => 'Microservices Architecture',
                'sks' => 3,
                'lecturer' => 'Prof. Dedi Kurniawan',
                'description' => 'Desain dan implementasi arsitektur microservices dengan praktik CI/CD.',
                'category' => 'Peminatan',
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}