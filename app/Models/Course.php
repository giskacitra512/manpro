<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'semester',
        'credits',
        'description',
    ];

    protected $casts = [
        'semester' => 'integer',
        'credits' => 'integer',
    ];

    /**
     * Get all materials for this course.
     */
    public function materials()
    {
        return $this->hasMany(Material::class)->latest();
    }
}
