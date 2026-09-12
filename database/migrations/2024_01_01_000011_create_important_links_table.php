<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('important_links', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url', 500);
            $table->string('description', 500)->nullable();
            $table->string('category', 100)->default('Quick Links')->index();
            $table->string('icon', 100)->default('external-link');
            $table->boolean('is_active')->default(true)->index();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('important_links');
    }
};
