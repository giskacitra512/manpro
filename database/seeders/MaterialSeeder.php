<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;
use App\Models\User;
use App\Models\Course;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@Brain.com')->first();

        $courses = Course::all();

        if ($courses->isEmpty()) {
            $this->command->info('Tidak ada course. Jalankan CourseSeeder terlebih dahulu.');
            return;
        }

        $materials = [];

        foreach ($courses as $course) {
            $materials[] = [
                'title' => 'Pengantar ' . $course->name,
                'description' => 'Materi pengenalan dasar tentang ' . $course->name,
                'content' => "Ini adalah materi pengenalan untuk mata kuliah {$course->name}.\n\nTopik yang akan dipelajari:\n1. Konsep dasar\n2. Teori fundamental\n3. Aplikasi praktis\n4. Studi kasus\n5. Best practices",
                'course_id' => $course->id,
                'user_id' => $admin->id,
            ];

            $materials[] = [
                'title' => 'Teori dan Konsep ' . $course->name,
                'description' => 'Pembahasan teori mendalam tentang ' . $course->name,
                'content' => "Materi ini membahas teori dan konsep penting dalam {$course->name}.\n\nBab yang dibahas:\n- Teori dasar\n- Implementasi\n- Analisis\n- Problem solving\n- Latihan soal",
                'course_id' => $course->id,
                'user_id' => $admin->id,
            ];

            if ($course->semester <= 4) {
                $materials[] = [
                    'title' => 'Praktikum ' . $course->name,
                    'description' => 'Panduan praktikum untuk ' . $course->name,
                    'content' => "Panduan praktikum {$course->name}:\n\n1. Persiapan alat dan bahan\n2. Prosedur praktikum\n3. Pengambilan data\n4. Analisis hasil\n5. Laporan praktikum",
                    'course_id' => $course->id,
                    'user_id' => $admin->id,
                ];
            }
        }

        foreach ($materials as $material) {
            Material::create($material);
        }

        $this->command->info('Materials seeded successfully!');
    }
}
