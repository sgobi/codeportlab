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
        Schema::create('site_profiles', function (Blueprint $table) {
            $table->id();
            // Header & Branding
            $table->string('brand_name')->default('CodePort');
            $table->string('brand_accent')->default('Lab');
            $table->string('tagline')->default('CLOUD & DEVOPS');
            $table->string('logo_path')->nullable();

            // Founder & Profile (Footer)
            $table->string('founder_name')->default('Gobikrishna Subramaniyam');
            $table->string('founder_title')->default('Founder & Senior Cloud Architect @ CodePortLab');
            $table->string('founder_initials')->default('GS');
            $table->string('founder_avatar')->nullable();
            $table->string('location')->default('Jaffna, Sri Lanka / UTC+5:30');
            $table->string('email')->default('gobikrishnasubramaniyam@hotmail.com');

            // Social Proof
            $table->string('github_url')->nullable()->default('https://github.com/gobik1990');
            $table->string('linkedin_url')->nullable()->default('https://www.linkedin.com/in/gobikrishna-subramaniyam');
            $table->string('medium_url')->nullable()->default('https://medium.com/@gobik1990');

            // Footer Notice
            $table->string('copyright_text')->default('CodePortLab. Cloud & DevOps B2B Consulting.');
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_profiles');
    }
};
