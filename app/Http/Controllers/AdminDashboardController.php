<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_materials' => Material::count(),
            'total_courses' => Course::count(),
            'total_users' => User::count(),
            'total_mahasiswa' => User::where('role_id', 2)->count(),
            'recent_materials' => Material::with('course')->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
