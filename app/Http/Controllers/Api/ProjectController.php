<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectDetail;
use App\Services\CloudinaryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
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
        $projects = Project::select(['id', 'title', 'level', 'description', 'image', 'thumbnail', 'tags', 'has_details', 'sort_order'])
            ->orderBy('sort_order')
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
        $project = Project::with('detail')
            ->select(['id', 'title', 'level', 'description', 'image', 'thumbnail', 'tags', 'has_details', 'sort_order'])
            ->findOrFail($id);
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
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'image'          => 'nullable',
            'thumbnail'      => 'nullable',
            'sort_order'     => 'nullable|integer',
            'tags'           => 'nullable',
            'existingImages' => 'nullable',
            'imageFiles'     => 'nullable',
            'imageFiles.*'   => 'nullable',
            'has_details'    => 'nullable',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $imagePaths = [];
            $existingImages = $request->input('existingImages', []);
            if (is_string($existingImages)) {
                $existingImages = json_decode($existingImages, true) ?? [];
            }
            $imagePaths = array_merge($imagePaths, $existingImages);

            if ($request->hasFile('imageFiles')) {
                foreach ($request->file('imageFiles') as $file) {
                    $imagePaths[] = $this->uploadFile($file);
                }
            }

            $imagePaths = array_slice($imagePaths, 0, 7);

            $thumbnailPath = $request->input('thumbnail');
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $this->uploadFile($request->file('thumbnail'));
            }

            $tags = $request->input('tags', []);
            if (is_string($tags)) {
                $tags = json_decode($tags, true) ?? [];
            }

            $hasDetails = $request->input('has_details', false);
            if (is_string($hasDetails)) {
                $hasDetails = filter_var($hasDetails, FILTER_VALIDATE_BOOLEAN);
            }

            $project = Project::create([
                'title'       => $request->title,
                'description' => $request->description,
                'image'       => empty($imagePaths) ? [] : $imagePaths,
                'thumbnail'   => $thumbnailPath,
                'tags'        => $tags,
                'has_details' => $hasDetails,
                'sort_order'  => $request->input('sort_order', Project::max('sort_order') + 1),
            ]);

            $detailData = $request->input('detailData');
            if (is_string($detailData)) {
                $detailData = json_decode($detailData, true);
            }

            if ($request->hasFile('galleryFiles')) {
                $detailData['gallery'] = $detailData['gallery'] ?? [];
                foreach ($request->file('galleryFiles') as $file) {
                    $detailData['gallery'][] = $this->uploadFile($file);
                }
            }

            if ($detailData) {
                $project->detail()->create($this->detailPayload($detailData));
            }

            DB::commit();
            return response()->json($this->fullShape($project->load('detail')), 201);
        } catch (\Throwable $e) {
            DB::rollBack();
            $debug = config('app.debug')
                ? ['class' => get_class($e), 'file' => $e->getFile(), 'line' => $e->getLine(), 'trace' => $e->getTraceAsString()]
                : [];
            return response()->json(['error' => $e->getMessage(), ...$debug], 500);
        }
    }

    /**
     * PUT /api/admin/projects/{id}
     * Update an existing project and its detailData.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $v = Validator::make($request->all(), [
            'title'          => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'sort_order'     => 'nullable|integer',
            'tags'           => 'nullable',
            'existingImages' => 'nullable',
            'imageFiles'     => 'nullable',
            'imageFiles.*'   => 'nullable',
            'has_details'    => 'nullable',
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 422);
        }

        $project = Project::with('detail')->findOrFail($id);

        DB::beginTransaction();
        try {
            $updateData = [
                'title'       => $request->title,
                'description' => $request->description,
                'sort_order'  => $request->sort_order,
            ];

            $imagePaths = [];
            $hasImageUpdate = false;

            if ($request->has('existingImages')) {
                $hasImageUpdate = true;
                $existingImages = $request->input('existingImages');
                $imagePaths = is_string($existingImages) ? (json_decode($existingImages, true) ?? []) : $existingImages;
            }

            if ($request->hasFile('imageFiles')) {
                $hasImageUpdate = true;
                foreach ($request->file('imageFiles') as $file) {
                    $imagePaths[] = $this->uploadFile($file);
                }
            }

            if ($hasImageUpdate) {
                $updateData['image'] = array_slice($imagePaths, 0, 7);
            }

            if ($request->hasFile('thumbnail')) {
                $updateData['thumbnail'] = $this->uploadFile($request->file('thumbnail'));
            } elseif ($request->has('thumbnail')) { // allow nulling out
                $updateData['thumbnail'] = $request->thumbnail;
            }

            if ($request->has('tags')) {
                $tags = $request->tags;
                $updateData['tags'] = is_string($tags) ? (json_decode($tags, true) ?? []) : $tags;
            }

            if ($request->has('has_details')) {
                $hasDetails = $request->has_details;
                $updateData['has_details'] = is_string($hasDetails) ? filter_var($hasDetails, FILTER_VALIDATE_BOOLEAN) : $hasDetails;
            }

            $project->update(array_filter($updateData, fn ($v) => $v !== null));

            if ($request->has('detailData')) {
                $detailData = $request->detailData;
                if (is_string($detailData)) {
                    $detailData = json_decode($detailData, true);
                }

                if ($request->hasFile('galleryFiles')) {
                    $detailData['gallery'] = $detailData['gallery'] ?? [];
                    foreach ($request->file('galleryFiles') as $file) {
                        $detailData['gallery'][] = $this->uploadFile($file);
                    }
                }

                if ($detailData) {
                    $payload = $this->detailPayload($detailData);
                    if ($project->detail) {
                        $project->detail->update($payload);
                    } else {
                        $project->detail()->create($payload);
                    }
                }
            }

            DB::commit();
            return response()->json($this->fullShape($project->fresh('detail')));
        } catch (\Throwable $e) {
            DB::rollBack();
            $debug = config('app.debug')
                ? ['class' => get_class($e), 'file' => $e->getFile(), 'line' => $e->getLine()]
                : [];
            return response()->json(['error' => $e->getMessage(), ...$debug], 500);
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
        $projects = Project::select(['id', 'title', 'level', 'description', 'image', 'thumbnail', 'tags', 'has_details', 'sort_order', 'created_at'])
            ->orderBy('sort_order')
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
            'level'       => $p->level,
            'description' => $p->description,
            'image'       => $p->image,
            'thumbnail'   => $p->thumbnail,
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

    /**
     * Upload a file to Cloudinary (production) or local disk (dev fallback).
     * Returns a persistent public URL.
     */
    private function uploadFile(UploadedFile $file): string
    {
        $cloudName = config('services.cloudinary.cloud_name');

        if ($cloudName) {
            // Cloudinary — persistent CDN storage
            return (new CloudinaryService())->upload($file, 'portfolio/projects');
        }

        // Fallback: local disk (dev only — ephemeral on Render)
        return '/storage/' . $file->store('projects', 'public');
    }
}
