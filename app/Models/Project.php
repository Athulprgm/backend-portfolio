<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'tags',
        'has_details',
        'sort_order',
    ];

    protected $casts = [
        'tags'        => 'array',
        'has_details' => 'boolean',
        'sort_order'  => 'integer',
    ];

    public function detail(): HasOne
    {
        return $this->hasOne(ProjectDetail::class);
    }
}
