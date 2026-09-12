<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained('departments')->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->string('name');
            $table->string('code', 50); // e.g. BCA, BBA, BA, B.Sc
            $table->string('slug')->unique();
            $table->integer('duration_years')->default(3);
            $table->integer('total_semesters')->default(6);
            $table->text('description')->nullable();
            $table->string('badge_color', 50)->default('blue'); // For pastel color matching UI: blue, green, orange, purple
            $table->boolean('is_active')->default(true)->index();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
