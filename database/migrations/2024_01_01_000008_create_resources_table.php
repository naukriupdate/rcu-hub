<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->index();
            $table->text('description')->nullable();
            
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('uploader_type', ['student', 'teacher'])->default('student')->index();
            $table->string('uploader_name');
            
            $table->foreignId('department_id')->constrained('departments')->cascadeOnDelete();
            $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('semester_id')->constrained('semesters')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->foreignId('resource_type_id')->constrained('resource_types')->cascadeOnDelete();
            
            $table->string('academic_year', 20)->nullable();
            $table->string('file_path', 500);
            $table->string('file_name');
            $table->string('file_type', 20); // pdf, docx, etc.
            $table->string('mime_type', 100);
            $table->unsignedBigInteger('file_size');
            $table->string('file_hash', 64)->index();
            
            $table->enum('status', ['pending', 'approved', 'rejected', 'archived'])->default('pending')->index();
            $table->text('rejection_reason')->nullable();
            $table->unsignedBigInteger('downloads_count')->default(0)->index();
            
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
