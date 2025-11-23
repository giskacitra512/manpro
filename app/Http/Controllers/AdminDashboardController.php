<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_materials' => Material::count(),
            'total_semesters' => Material::distinct('semester')->count('semester'),
            'recent_materials' => Material::latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
