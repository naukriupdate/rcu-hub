<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete();
            $table->integer('semester_number');
            $table->string('name', 100); // e.g. "Semester 1", "Semester 3"
            $table->string('slug', 100);
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();

            $table->unique(['program_id', 'semester_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('semesters');
    }
};
