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
        Schema::create('modul_files', function (Blueprint $table) {
    $table->id();
    $table->foreignId('modul_sektoral_id')->constrained()->cascadeOnDelete();
    $table->string('judul');
    $table->string('file');
    $table->integer('urutan')->default(1);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modul_files');
    }
};
