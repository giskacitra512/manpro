<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Material;
use Illuminate\Http\Request;

class AdminDiscussionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $materialId = $request->get('material_id');

        $query = Discussion::with(['user', 'material.course'])
            ->whereNull('parent_id'); // Only get main comments, not replies

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('comment', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($materialId) {
            $query->where('material_id', $materialId);
        }

        $discussions = $query->latest()->paginate(20);

        // Get materials for filter
        $materials = Material::orderBy('title')->get();

        return view('admin.discussions.index', compact('discussions', 'materials', 'search', 'materialId'));
    }

    public function destroy(Discussion $discussion)
    {
        // Delete all replies first
        $discussion->replies()->delete();

        // Delete the discussion
        $discussion->delete();

        return back()->with('success', 'Komentar dan semua balasannya berhasil dihapus!');
    }
}
