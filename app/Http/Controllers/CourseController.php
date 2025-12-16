<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of courses.
     */
    public function index(Request $request)
    {
        $semester = $request->get('semester');

        $query = Course::query();

        if ($semester) {
            $query->where('semester', $semester);
        }

        $courses = $query->orderBy('semester')->orderBy('name')->paginate(15);
        $semesters = Course::select('semester')->distinct()->orderBy('semester')->pluck('semester');

        return view('admin.courses.index', compact('courses', 'semesters', 'semester'));
    }

    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * Store a newly created course.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:20|unique:courses',
            'name' => 'required|string|max:255',
            'semester' => 'required|integer|min:1|max:8',
            'credits' => 'required|integer|min:1|max:6',
            'description' => 'nullable|string',
        ]);

        Course::create($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    /**
     * Display the specified course.
     */
    public function show(Course $course)
    {
        $course->load('materials');
        return view('admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified course.
     */
    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    /**
     * Update the specified course.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:20|unique:courses,code,' . $course->id,
            'name' => 'required|string|max:255',
            'semester' => 'required|integer|min:1|max:8',
            'credits' => 'required|integer|min:1|max:6',
            'description' => 'nullable|string',
        ]);

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Mata kuliah berhasil diupdate!');
    }

    /**
     * Remove the specified course.
     */
    public function destroy(Course $course)
    {
        // Check if course has materials
        if ($course->materials()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus mata kuliah yang masih memiliki materi!');
        }

        $course->delete();

        return redirect()->route('admin.courses.index')->with('success', 'Mata kuliah berhasil dihapus!');
    }
}
