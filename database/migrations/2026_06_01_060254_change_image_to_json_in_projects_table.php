<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Wrap existing single image strings into a json array
        DB::statement('ALTER TABLE projects ALTER COLUMN image TYPE jsonb USING json_build_array(image)::jsonb');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Unpack the first element of the json array back into a string
        DB::statement("ALTER TABLE projects ALTER COLUMN image TYPE varchar USING image->>0");
    }
};
