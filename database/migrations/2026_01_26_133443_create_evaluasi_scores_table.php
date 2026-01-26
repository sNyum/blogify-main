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
        Schema::create('evaluasi_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('external_user_id')->constrained('external_users')->onDelete('cascade');
            $table->string('domain');
            $table->decimal('score_pm', 5, 2)->default(0); // Penilaian Mandiri
            $table->decimal('score_pb', 5, 2)->default(0); // Penilaian Badan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluasi_scores');
    }
};
