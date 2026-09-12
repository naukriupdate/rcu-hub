<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resource_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100); // Notes, Previous Year Papers, Question Banks, Syllabus, Assignments, Practical Files, Lab Manuals, etc.
            $table->string('slug', 100)->unique();
            $table->string('subtitle')->nullable(); // e.g. "Study materials & notes", "PYQs & model papers"
            $table->string('icon', 100)->default('file-text');
            $table->string('color_theme', 50)->default('blue'); // blue, green, purple, orange, teal
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resource_types');
    }
};
