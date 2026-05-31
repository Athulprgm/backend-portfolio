<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    // ─── Public endpoints ────────────────────────────────────────────────────

    /**
     * GET /api/projects
     * Returns all project cards ordered by sort_order (no detailData).
     */
    public function index(): JsonResponse
    {
        $projects = Project::orderBy('sort_order')
            ->get()
            ->map(fn (Project $p) => $this->cardShape($p));

        return response()->json($projects);
    }

    /**
     * GET /api/projects/{id}
     * Returns a single project with full detailData.
     */
    public function show(int $id): JsonResponse
    {
        $project = Project::with('detail')->findOrFail($id);
        return response()->json($this->fullShape($project));
    }

    // ─── Admin endpoints (protected by AdminApiKey middleware) ────────────────

    /**
     * POST /api/admin/projects
     * Create a new project (with optional detailData).
     */
    public function store(Request $request): JsonResponse
    {
        $v = Validator::make($request->all(), [
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'required|string',
            'tags'        => 'array',
            'has_details' => 'boolean',
            'sort_order'  => 'integer',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $project = Project::create([
                'title'       => $request->title,
                'description' => $request->description,
                'image'       => $request->image,
                'tags'        => $request->input('tags', []),
                'has_details' => $request->input('has_details', false),
                'sort_order'  => $request->input('sort_order', Project::max('sort_order') + 1),
            ]);

            if ($request->has('detailData')) {
                $project->detail()->create($this->detailPayload($request->detailData));
            }

            DB::commit();
            return response()->json($this->fullShape($project->load('detail')), 201);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * PUT /api/admin/projects/{id}
     * Update an existing project and its detailData.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $project = Project::with('detail')->findOrFail($id);

        DB::beginTransaction();
        try {
            $project->update(array_filter([
                'title'       => $request->title,
                'description' => $request->description,
                'image'       => $request->image,
                'tags'        => $request->tags,
                'has_details' => $request->has_details,
                'sort_order'  => $request->sort_order,
            ], fn ($v) => $v !== null));

            if ($request->has('detailData')) {
                $payload = $this->detailPayload($request->detailData);
                if ($project->detail) {
                    $project->detail->update($payload);
                } else {
                    $project->detail()->create($payload);
                }
            }

            DB::commit();
            return response()->json($this->fullShape($project->fresh('detail')));
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * DELETE /api/admin/projects/{id}
     * Delete a project (detail is cascaded by FK).
     */
    public function destroy(int $id): JsonResponse
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return response()->json(['message' => "Project {$id} deleted."]);
    }

    /**
     * GET /api/admin/projects
     * Same as index but includes sort_order — useful for the admin table.
     */
    public function adminIndex(): JsonResponse
    {
        $projects = Project::orderBy('sort_order')
            ->get()
            ->map(fn (Project $p) => [
                ...$this->cardShape($p),
                'sort_order'  => $p->sort_order,
                'created_at'  => $p->created_at?->toDateString(),
            ]);

        return response()->json($projects);
    }

    // ─── Private helpers ─────────────────────────────────────────────────────

    private function cardShape(Project $p): array
    {
        return [
            'id'          => $p->id,
            'title'       => $p->title,
            'description' => $p->description,
            'image'       => $p->image,
            'tags'        => $p->tags,
            'hasDetails'  => $p->has_details,
            'sort_order'  => $p->sort_order,
        ];
    }

    private function fullShape(Project $p): array
    {
        $data   = $this->cardShape($p);
        $detail = $p->detail;

        if ($detail) {
            $data['detailData'] = [
                'heroTitle'    => $detail->hero_title,
                'heroSubject'  => $detail->hero_subject,
                'tagline'      => $detail->tagline,
                'stats'        => $detail->stats        ?? [],
                'abstract'     => $detail->abstract,
                'gallery'      => $detail->gallery      ?? [],
                'features'     => $detail->features     ?? [],
                'technologies' => $detail->technologies ?? [],
                'modules'      => $detail->modules      ?? [],
                'highlights'   => $detail->highlights,
                'repoUrl'      => $detail->repo_url,
                'liveUrl'      => $detail->live_url,
            ];
        }

        return $data;
    }

    private function detailPayload(array|object $d): array
    {
        $d = (array) $d;
        return [
            'hero_title'    => $d['heroTitle']    ?? '',
            'hero_subject'  => $d['heroSubject']  ?? '',
            'tagline'       => $d['tagline']      ?? '',
            'stats'         => $d['stats']        ?? [],
            'abstract'      => $d['abstract']     ?? '',
            'gallery'       => $d['gallery']      ?? [],
            'features'      => $d['features']     ?? [],
            'technologies'  => $d['technologies'] ?? [],
            'modules'       => $d['modules']      ?? [],
            'highlights'    => $d['highlights']   ?? null,
            'repo_url'      => $d['repoUrl']      ?? null,
            'live_url'      => $d['liveUrl']      ?? null,
        ];
    }
}
