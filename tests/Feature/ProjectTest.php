<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_project_via_api(): void
    {
        $response = $this->postJson('/api/admin/projects', [
            'title' => 'Test Project',
            'description' => 'Test Description',
            'tags' => ['PHP', 'Laravel', 'Vue'],
            'existingImages' => ['/img1.png'],
        ], [
            'X-Admin-Key' => 'portfolio-admin-2026',
        ]);

        $response->assertStatus(201);
        
        $project = Project::first();
        dump('Attributes:', $project->getAttributes());
        dump('Tags:', $project->tags);

        $this->assertDatabaseHas('projects', [
            'title' => 'Test Project',
        ]);

        $this->assertEquals(['PHP', 'Laravel', 'Vue'], $project->tags);
        $this->assertEquals(['/img1.png'], $project->image);
    }

    public function test_can_update_project_via_api(): void
    {
        $project = Project::create([
            'title' => 'Original Title',
            'description' => 'Original Desc',
            'image' => ['/img1.png'],
            'tags' => ['old'],
            'has_details' => false,
            'sort_order' => 5,
        ]);

        $response = $this->postJson("/api/admin/projects/{$project->id}", [
            '_method' => 'PUT',
            'title' => 'Updated Title',
            'tags' => ['new', 'improved'],
            'existingImages' => ['/img2.png'],
        ], [
            'X-Admin-Key' => 'portfolio-admin-2026',
        ]);

        $response->assertStatus(200);

        $project->refresh();
        $this->assertEquals('Updated Title', $project->title);
        $this->assertEquals(['new', 'improved'], $project->tags);
        $this->assertEquals(['/img2.png'], $project->image);
    }
}
