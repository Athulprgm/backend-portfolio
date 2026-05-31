<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->string('hero_title');
            $table->string('hero_subject');
            $table->string('tagline');
            $table->jsonb('stats')->default('[]');
            $table->text('abstract');
            $table->jsonb('gallery')->default('[]');
            $table->jsonb('features')->default('[]');
            $table->jsonb('technologies')->default('[]');
            $table->jsonb('modules')->default('[]');
            $table->jsonb('highlights')->nullable();
            $table->string('repo_url')->nullable();
            $table->string('live_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_details');
    }
};
