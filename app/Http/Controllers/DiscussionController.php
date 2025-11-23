<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Material;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    /**
     * Store a new discussion comment.
     */
    public function store(Request $request, Material $material)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:discussions,id',
        ]);

        Discussion::create([
            'material_id' => $material->id,
            'user_id' => auth()->id(),
            'parent_id' => $validated['parent_id'] ?? null,
            'comment' => $validated['comment'],
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    /**
     * Delete a discussion comment.
     */
    public function destroy(Discussion $discussion)
    {
        // Check if user owns the comment or is admin
        if ($discussion->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $discussion->delete();

        return back()->with('success', 'Komentar berhasil dihapus!');
    }
}
