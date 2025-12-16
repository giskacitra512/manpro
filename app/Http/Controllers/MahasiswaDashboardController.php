<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Course;
use Illuminate\Http\Request;

class MahasiswaDashboardController extends Controller
{
    public function index(Request $request)
    {
        $semester = $request->get('semester');

        // Jika ada parameter semester, tampilkan courses
        if ($semester) {
            $courses = Course::withCount('materials')
                ->where('semester', $semester)
                ->orderBy('name')
                ->get();

            $stats = [
                'total_materials' => Material::count(),
                'total_courses' => Course::count(),
                'semesters' => Course::select('semester')->distinct()->orderBy('semester')->pluck('semester'),
            ];

            return view('mahasiswa.courses', compact('courses', 'stats', 'semester'));
        }

        // Jika tidak ada parameter, tampilkan dashboard dengan recent materials
        $recentMaterials = Material::with('course')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $stats = [
            'total_materials' => Material::count(),
            'total_courses' => Course::count(),
            'semesters' => Course::select('semester')->distinct()->orderBy('semester')->pluck('semester'),
        ];

        return view('mahasiswa.dashboard', compact('recentMaterials', 'stats'));
    }

    public function courseMaterials(Course $course)
    {
        $materials = Material::where('course_id', $course->id)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('mahasiswa.course-materials', compact('course', 'materials'));
    }

    public function materials(Request $request)
    {
        $semester = $request->get('semester');

        $query = Course::withCount('materials');

        // Filter by semester
        if ($semester) {
            $query->where('semester', $semester);
        }

        $courses = $query->orderBy('semester')->orderBy('name')->paginate(12);

        // Get all semesters for filter
        $semesters = Course::select('semester')->distinct()->orderBy('semester')->pluck('semester');

        return view('mahasiswa.materials', compact('courses', 'semester', 'semesters'));
    }

    public function show(Material $material)
    {
        $material->load(['course', 'discussions.user', 'discussions.replies.user']);
        return view('mahasiswa.material-detail', compact('material'));
    }
}
