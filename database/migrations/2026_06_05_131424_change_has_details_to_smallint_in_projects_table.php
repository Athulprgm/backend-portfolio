<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Change `has_details` from BOOLEAN to SMALLINT.
 *
 * Root cause of the original 500:
 *   ATTR_EMULATE_PREPARES=true converts PHP `true` → integer literal 1.
 *   PostgreSQL boolean column rejects integer 1 → SQLSTATE[42804].
 *
 * Root cause of THIS migration's first deploy failure:
 *   PostgreSQL cannot change a column's type while a DEFAULT of the old
 *   type (DEFAULT false :: boolean) is still attached. Must DROP DEFAULT
 *   first, then ALTER TYPE, then SET DEFAULT again.
 *
 * Fix:
 *   SMALLINT accepts integer 1/0 cleanly.
 *   The Eloquent `'boolean'` cast still works:
 *     - READ:  smallint 1/0 → cast → PHP true/false ✅
 *     - WRITE: PHP true/false → PDO emulation → int 1/0 → smallint ✅
 */
return new class extends Migration
{
    public function up(): void
    {
        if (DB::connection()->getDriverName() === 'sqlite') {
            return;
        }

        // 1. Drop the boolean DEFAULT — cannot auto-cast false::boolean to smallint
        DB::statement('ALTER TABLE projects ALTER COLUMN has_details DROP DEFAULT');

        // 2. Change column type — USING converts: true→1, false→0
        DB::statement('ALTER TABLE projects ALTER COLUMN has_details TYPE smallint USING (has_details::int)');

        // 3. Re-attach a smallint-compatible default
        DB::statement('ALTER TABLE projects ALTER COLUMN has_details SET DEFAULT 0');
    }

    public function down(): void
    {
        if (DB::connection()->getDriverName() === 'sqlite') {
            return;
        }

        // 1. Drop the smallint default
        DB::statement('ALTER TABLE projects ALTER COLUMN has_details DROP DEFAULT');

        // 2. Revert to boolean — USING: 0→false, non-zero→true
        DB::statement('ALTER TABLE projects ALTER COLUMN has_details TYPE boolean USING (has_details <> 0)');

        // 3. Re-attach boolean default
        DB::statement('ALTER TABLE projects ALTER COLUMN has_details SET DEFAULT false');
    }
};
