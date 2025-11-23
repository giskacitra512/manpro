<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MahasiswaDashboardController extends Controller
{
    public function index()
    {
        $materials = Material::orderBy('semester')->orderBy('created_at', 'desc')->take(10)->get();

        $stats = [
            'total_materials' => Material::count(),
            'semesters' => Material::select('semester')->distinct()->orderBy('semester')->pluck('semester'),
        ];

        return view('mahasiswa.dashboard', compact('materials', 'stats'));
    }

    public function materials(Request $request)
    {
        $semester = $request->get('semester', 1);

        $materials = Material::where('semester', $semester)
            ->orderBy('mata_kuliah')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('mahasiswa.materials', compact('materials', 'semester'));
    }

    public function show(Material $material)
    {
        $material->load(['discussions.user', 'discussions.replies.user']);
        return view('mahasiswa.material-detail', compact('material'));
    }
}
