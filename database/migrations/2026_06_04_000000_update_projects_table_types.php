<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // For Neon compatibility, we drop and recreate the column if it's varchar
        // Or we use native Laravel change() if doctrine/dbal is installed. 
        // Laravel 11+ supports native Schema type changes for Postgres.
        
        Schema::table('projects', function (Blueprint $table) {
            // Convert to JSON natively
            $table->json('image')->nullable()->change();
            $table->json('tags')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
            $table->string('tags')->nullable()->change();
        });
    }
};
