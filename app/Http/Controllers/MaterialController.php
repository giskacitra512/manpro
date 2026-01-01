<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    /**
     * Display a listing of materials (Admin).
     */
    public function index(Request $request)
    {
        $semester = $request->get('semester');
        $courseId = $request->get('course_id');

        $query = Material::with(['user', 'course']);

        if ($semester) {
            $query->whereHas('course', function($q) use ($semester) {
                $q->where('semester', $semester);
            });
        }

        if ($courseId) {
            $query->where('course_id', $courseId);
        }

        $materials = $query->orderBy('created_at', 'desc')->paginate(15);

        $semesters = Course::select('semester')->distinct()->orderBy('semester')->pluck('semester');
        $courses = $semester
            ? Course::where('semester', $semester)->orderBy('name')->get()
            : Course::orderBy('name')->get();

        return view('admin.materials.index', compact('materials', 'semesters', 'courses', 'semester', 'courseId'));
    }

    /**
     * Show the form for creating a new material.
     */
    public function create()
    {
        $courses = Course::orderBy('semester')->orderBy('name')->get();
        return view('admin.materials.create', compact('courses'));
    }

    /**
     * Store a newly created material.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
            'course_id' => 'required|exists:courses,id',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('materials', 'public');
        }

        Material::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'content' => $validated['content'],
            'file_path' => $filePath,
            'course_id' => $validated['course_id'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.materials.index')->with('success', 'Materi berhasil ditambahkan!');
    }

    /**
     * Display the specified material.
     */
    public function show(Material $material)
    {
        $material->load(['course', 'discussions.user', 'discussions.replies.user']);
        return view('admin.materials.show', compact('material'));
    }

    /**
     * Show the form for editing the specified material.
     */
    public function edit(Material $material)
    {
        $courses = Course::orderBy('semester')->orderBy('name')->get();
        return view('admin.materials.edit', compact('material', 'courses'));
    }

    /**
     * Update the specified material.
     */
    public function update(Request $request, Material $material)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
            'course_id' => 'required|exists:courses,id',
        ]);

        if ($request->hasFile('file')) {
            // Delete old file
            if ($material->file_path) {
                Storage::disk('public')->delete($material->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('materials', 'public');
        }

        $material->update($validated);

        return redirect()->route('admin.materials.index')->with('success', 'Materi berhasil diupdate!');
    }

    /**
     * Remove the specified material.
     */
    public function destroy(Material $material)
    {
        if ($material->file_path) {
            Storage::disk('public')->delete($material->file_path);
        }

        $material->delete();

        return redirect()->route('admin.materials.index')->with('success', 'Materi berhasil dihapus!');
    }
}
