<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resource_id')->constrained('resources')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('reporter_name');
            $table->string('reporter_email');
            $table->enum('reason', ['wrong_content', 'duplicate', 'copyright', 'incorrect_info', 'offensive', 'broken_file', 'other'])->index();
            $table->text('details');
            $table->enum('status', ['pending', 'reviewed', 'dismissed', 'actioned'])->default('pending')->index();
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
