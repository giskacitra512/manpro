<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'content',
        'file_path',
        'course_id',
        'user_id',
    ];

    /**
     * Get the course that this material belongs to.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the user that uploaded the material.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all discussions for this material.
     */
    public function discussions()
    {
        return $this->hasMany(Discussion::class)->whereNull('parent_id')->with(['user', 'replies'])->latest();
    }
}
