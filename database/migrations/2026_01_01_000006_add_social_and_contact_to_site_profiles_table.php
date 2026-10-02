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
        Schema::table('site_profiles', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('twitter_url')->nullable()->after('medium_url');
            $table->string('youtube_url')->nullable()->after('twitter_url');
            $table->json('custom_social_links')->nullable()->after('youtube_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_profiles', function (Blueprint $table) {
            $table->dropColumn(['phone', 'twitter_url', 'youtube_url', 'custom_social_links']);
        });
    }
};
