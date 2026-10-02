<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->index(['is_featured', 'sort_order'], 'idx_projects_featured_sort');
        });

        Schema::table('skills', function (Blueprint $table) {
            $table->index(['sort_order'], 'idx_skills_sort');
        });

        Schema::table('tech_updates', function (Blueprint $table) {
            $table->index(['is_published', 'is_pinned', 'published_at'], 'idx_tech_updates_pub_pin_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex('idx_projects_featured_sort');
        });

        Schema::table('skills', function (Blueprint $table) {
            $table->dropIndex('idx_skills_sort');
        });

        Schema::table('tech_updates', function (Blueprint $table) {
            $table->dropIndex('idx_tech_updates_pub_pin_date');
        });
    }
};
