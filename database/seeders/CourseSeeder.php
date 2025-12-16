<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            // Semester 1
            ['code' => 'TIF101', 'name' => 'Pengantar Teknologi Informasi', 'semester' => 1, 'credits' => 3, 'description' => 'Mata kuliah dasar tentang TI'],
            ['code' => 'TIF102', 'name' => 'Algoritma dan Pemrograman', 'semester' => 1, 'credits' => 4, 'description' => 'Dasar-dasar algoritma dan programming'],
            ['code' => 'TIF103', 'name' => 'Matematika Diskrit', 'semester' => 1, 'credits' => 3, 'description' => 'Matematika untuk komputer'],

            // Semester 2
            ['code' => 'TIF201', 'name' => 'Struktur Data', 'semester' => 2, 'credits' => 4, 'description' => 'Struktur data dan implementasinya'],
            ['code' => 'TIF202', 'name' => 'Pemrograman Berorientasi Objek', 'semester' => 2, 'credits' => 3, 'description' => 'Konsep OOP'],
            ['code' => 'TIF203', 'name' => 'Basis Data', 'semester' => 2, 'credits' => 3, 'description' => 'Pengenalan database'],

            // Semester 3
            ['code' => 'TIF301', 'name' => 'Pemrograman Web', 'semester' => 3, 'credits' => 3, 'description' => 'Pengembangan aplikasi web'],
            ['code' => 'TIF302', 'name' => 'Sistem Operasi', 'semester' => 3, 'credits' => 3, 'description' => 'Konsep sistem operasi'],
            ['code' => 'TIF303', 'name' => 'Jaringan Komputer', 'semester' => 3, 'credits' => 3, 'description' => 'Dasar-dasar jaringan'],

            // Semester 4
            ['code' => 'TIF401', 'name' => 'Rekayasa Perangkat Lunak', 'semester' => 4, 'credits' => 3, 'description' => 'Software engineering'],
            ['code' => 'TIF402', 'name' => 'Desain dan Analisis Algoritma', 'semester' => 4, 'credits' => 3, 'description' => 'Algoritma lanjutan'],
            ['code' => 'TIF403', 'name' => 'Interaksi Manusia dan Komputer', 'semester' => 4, 'credits' => 3, 'description' => 'UI/UX design'],

            // Semester 5
            ['code' => 'TIF501', 'name' => 'Kecerdasan Buatan', 'semester' => 5, 'credits' => 3, 'description' => 'Pengenalan AI'],
            ['code' => 'TIF502', 'name' => 'Keamanan Informasi', 'semester' => 5, 'credits' => 3, 'description' => 'Security dan enkripsi'],
            ['code' => 'TIF503', 'name' => 'Pemrograman Mobile', 'semester' => 5, 'credits' => 3, 'description' => 'Pengembangan aplikasi mobile'],

            // Semester 6
            ['code' => 'TIF601', 'name' => 'Data Mining', 'semester' => 6, 'credits' => 3, 'description' => 'Analisis data besar'],
            ['code' => 'TIF602', 'name' => 'Cloud Computing', 'semester' => 6, 'credits' => 3, 'description' => 'Komputasi awan'],
            ['code' => 'TIF603', 'name' => 'Internet of Things', 'semester' => 6, 'credits' => 3, 'description' => 'IoT dan aplikasinya'],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
