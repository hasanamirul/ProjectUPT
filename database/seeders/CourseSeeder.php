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
            [
                'course_code' => 'IT201',
                'name' => 'Big Data Analytics',
                'sks' => 3,
                'lecturer' => 'Dr. Firman Hadiwijaya',
                'description' => 'Teknologi big data, Hadoop, Spark, data warehousing, dan business intelligence.',
                'category' => 'Peminatan',
            ],
            [
                'course_code' => 'IT202',
                'name' => 'Artificial Intelligence',
                'sks' => 3,
                'lecturer' => 'Prof. Suryadi Santoso',
                'description' => 'Dasar-dasar AI, expert systems, natural language processing, dan computer vision.',
                'category' => 'Peminatan',
            ],
            [
                'course_code' => 'IT203',
                'name' => 'DevOps & CI/CD',
                'sks' => 2,
                'lecturer' => 'Ir. Bambang Mulyo',
                'description' => 'Continuous integration, continuous deployment, containerization, dan infrastructure automation.',
                'category' => 'Peminatan',
            ],
            [
                'course_code' => 'IT204',
                'name' => 'Blockchain Technology',
                'sks' => 3,
                'lecturer' => 'Dr. Agus Kurniawan',
                'description' => 'Teknologi blockchain, cryptocurrency, smart contracts, dan aplikasi terdesentralisasi.',
                'category' => 'Peminatan',
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
