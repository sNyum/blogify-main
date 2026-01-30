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
        Schema::table('evaluasi_scores', function (Blueprint $table) {
            $table->string('nilai_pemeriksaan')->nullable()->after('score_pb'); // Dropdown value
            $table->text('catatan_pb')->nullable()->after('nilai_pemeriksaan'); // PB notes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluasi_scores', function (Blueprint $table) {
            $table->dropColumn(['nilai_pemeriksaan', 'catatan_pb']);
        });
    }
};
