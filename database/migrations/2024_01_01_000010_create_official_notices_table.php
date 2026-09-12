<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('official_notices', function (Blueprint $table) {
            $table->id();
            $table->string('external_id', 100)->nullable()->index();
            $table->string('source', 100)->default('rcu_wordpress_api')->index();
            $table->string('title', 500);
            $table->string('slug', 500)->nullable();
            $table->string('category', 50)->default('Latest')->index(); // Latest, Exams, Results, Others
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->timestamp('published_at')->nullable()->index();
            $table->string('featured_image_url', 500)->nullable();
            $table->string('original_url', 500)->nullable();
            $table->boolean('is_new')->default(true);
            $table->boolean('is_active')->default(true)->index();
            $table->timestamp('last_synced_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('official_notices');
    }
};
