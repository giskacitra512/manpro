<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    /**
     * Display a listing of materials (Admin).
     */
    public function index()
    {
        $materials = Material::with('user')->orderBy('semester')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new material.
     */
    public function create()
    {
        return view('admin.materials.create');
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
            'semester' => 'required|integer|min:1|max:8',
            'mata_kuliah' => 'required|string|max:255',
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
            'semester' => $validated['semester'],
            'mata_kuliah' => $validated['mata_kuliah'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.materials.index')->with('success', 'Materi berhasil ditambahkan!');
    }

    /**
     * Display the specified material.
     */
    public function show(Material $material)
    {
        return view('admin.materials.show', compact('material'));
    }

    /**
     * Show the form for editing the specified material.
     */
    public function edit(Material $material)
    {
        return view('admin.materials.edit', compact('material'));
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
            'semester' => 'required|integer|min:1|max:8',
            'mata_kuliah' => 'required|string|max:255',
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
