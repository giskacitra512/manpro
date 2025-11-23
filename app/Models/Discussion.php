<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_id',
        'user_id',
        'parent_id',
        'comment',
    ];

    /**
     * Get the material that this discussion belongs to.
     */
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    /**
     * Get the user who posted this discussion.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent comment (for replies).
     */
    public function parent()
    {
        return $this->belongsTo(Discussion::class, 'parent_id');
    }

    /**
     * Get all replies to this comment.
     */
    public function replies()
    {
        return $this->hasMany(Discussion::class, 'parent_id')->with('user')->latest();
    }

    /**
     * Check if this is a reply.
     */
    public function isReply(): bool
    {
        return $this->parent_id !== null;
    }
}
