<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Project;

try {
    echo "Creating test project...\n";
    $project = Project::create([
        'title'       => 'Local Test Project',
        'description' => 'Testing casts',
        'image'       => ['https://example.com/image.png'],
        'thumbnail'   => 'https://example.com/thumb.png',
        'tags'        => ['PHP', 'Laravel'],
        'has_details' => true,
        'sort_order'  => 99,
    ]);
    echo "SUCCESS! Project ID: " . $project->id . "\n";
    
    // Clean up
    $project->delete();
    echo "Deleted test project.\n";
} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "Trace:\n" . $e->getTraceAsString() . "\n";
}
