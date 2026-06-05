<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Change `has_details` from BOOLEAN to SMALLINT.
 *
 * Root cause:
 *   Laravel uses PDO::ATTR_EMULATE_PREPARES=true for Neon/PgBouncer
 *   compatibility. In emulated mode, PDO converts PHP `true` to the
 *   integer literal 1 (unquoted) in the SQL string. PostgreSQL is
 *   strictly typed and will NOT implicitly cast integer 1 to boolean,
 *   resulting in:
 *     SQLSTATE[42804]: column "has_details" is of type boolean but
 *     expression is of type integer
 *
 * Fix:
 *   SMALLINT accepts integer 1/0 without any type mismatch.
 *   The Eloquent `'boolean'` cast in the model still works correctly:
 *     - On READ:  smallint 1/0 → cast → PHP true/false ✅
 *     - On WRITE: PHP true/false → PDO emulation → int 1/0 → smallint ✅
 */
return new class extends Migration
{
    public function up(): void
    {
        if (DB::connection()->getDriverName() === 'sqlite') {
            return; // SQLite is dynamically typed — no migration needed
        }

        // USING clause converts existing boolean values to integer:
        //   true  → 1
        //   false → 0
        DB::statement(<<<'SQL'
            ALTER TABLE projects
            ALTER COLUMN has_details TYPE smallint
            USING (has_details::int)
        SQL);

        DB::statement(<<<'SQL'
            ALTER TABLE projects
            ALTER COLUMN has_details SET DEFAULT 0
        SQL);
    }

    public function down(): void
    {
        if (DB::connection()->getDriverName() === 'sqlite') {
            return;
        }

        // Restore to boolean — USING converts 0→false, non-zero→true
        DB::statement(<<<'SQL'
            ALTER TABLE projects
            ALTER COLUMN has_details TYPE boolean
            USING (has_details <> 0)
        SQL);

        DB::statement(<<<'SQL'
            ALTER TABLE projects
            ALTER COLUMN has_details SET DEFAULT false
        SQL);
    }
};
