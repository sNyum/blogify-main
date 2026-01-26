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
        Schema::create('coaching_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('external_user_id')->constrained('external_users')->onDelete('cascade');
            $table->enum('category', ['sk_tim', 'materi', 'dokumentasi', 'daftar_hadir', 'notulen']);
            $table->string('title')->nullable();
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type')->nullable(); // pdf, docx, img
            $table->string('file_size')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('uploaded_by_user_id')->nullable(); // If uploaded by BPS Admin (User model)
            $table->unsignedBigInteger('uploaded_by_bps_staff_id')->nullable(); // If uploaded by BPS Staff
            $table->timestamps();
            
            $table->index(['external_user_id', 'category']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coaching_documents');
    }
};
