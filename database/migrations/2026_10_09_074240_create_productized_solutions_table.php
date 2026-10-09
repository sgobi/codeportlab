<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productized_solutions', function (Blueprint $table) {
            $table->id();
            $table->string('icon_text', 10)->default('>_');
            $table->string('title');
            $table->text('description');
            $table->string('link_label');
            $table->string('link_url')->default('#contact');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('slug')->unique();
            $table->boolean('opens_modal')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productized_solutions');
    }
};
