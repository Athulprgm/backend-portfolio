<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Project extends Model
{
    protected $fillable = [
        'title',
        'level',
        'description',
        'image',
        'thumbnail',
        'tags',
        'has_details',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'has_details' => 'boolean',
            'sort_order'  => 'integer',
        ];
    }

    public function getImageAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    public function getTagsAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    public function detail(): HasOne
    {
        return $this->hasOne(ProjectDetail::class);
    }
}
