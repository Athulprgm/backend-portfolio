<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Definitively ensure `image` and `tags` columns in the projects table
 * are stored as PostgreSQL JSONB (binary JSON).
 *
 * Why this is needed:
 *  - The original create_projects_table migration created `image` as varchar.
 *  - A subsequent migration converted it using json_build_array() → jsonb.
 *  - Another migration used Laravel's json() blueprint which maps to the
 *    plain `json` type in PostgreSQL (NOT jsonb), silently downgrading it.
 *
 * JSONB vs JSON in PostgreSQL:
 *  - jsonb: binary format, validated on INSERT, supports GIN indexes, faster reads.
 *  - json:  text stored as-is, only validated on extraction, no indexing.
 *
 * The USING clause safely handles all possible prior states:
 *  - varchar  → jsonb  (if still a plain string like old images)
 *  - json     → jsonb  (standard promotion)
 *  - jsonb    → jsonb  (no-op, idempotent)
 */
return new class extends Migration
{
    public function up(): void
    {
        // SQLite doesn't support jsonb — skip for local dev/testing
        if (DB::connection()->getDriverName() === 'sqlite') {
            return;
        }

        // image: was varchar→jsonb→json. Force back to jsonb.
        // USING: cast via text so it works regardless of current underlying type.
        DB::statement(<<<'SQL'
            ALTER TABLE projects
            ALTER COLUMN image TYPE jsonb
            USING image::text::jsonb
        SQL);

        // tags: same story — was jsonb, then demoted to json.
        DB::statement(<<<'SQL'
            ALTER TABLE projects
            ALTER COLUMN tags TYPE jsonb
            USING tags::text::jsonb
        SQL);
    }

    public function down(): void
    {
        if (DB::connection()->getDriverName() === 'sqlite') {
            return;
        }

        // Revert to plain json (the state after update_projects_table_types)
        DB::statement(<<<'SQL'
            ALTER TABLE projects
            ALTER COLUMN image TYPE json
            USING image::text::json
        SQL);

        DB::statement(<<<'SQL'
            ALTER TABLE projects
            ALTER COLUMN tags TYPE json
            USING tags::text::json
        SQL);
    }
};
