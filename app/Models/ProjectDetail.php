<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectDetail extends Model
{
    protected $fillable = [
        'project_id',
        'hero_title',
        'hero_subject',
        'tagline',
        'stats',
        'abstract',
        'gallery',
        'features',
        'technologies',
        'modules',
        'highlights',
        'repo_url',
        'live_url',
    ];

    protected $casts = [
        'stats'        => 'array',
        'gallery'      => 'array',
        'features'     => 'array',
        'technologies' => 'array',
        'modules'      => 'array',
        'highlights'   => 'array',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
