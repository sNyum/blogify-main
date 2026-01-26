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
            $table->foreignId('internal_user_id')->nullable()->constrained('bps_staff')->onDelete('cascade');
            $table->unsignedBigInteger('external_user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluasi_scores', function (Blueprint $table) {
            $table->dropForeign(['internal_user_id']);
            $table->dropColumn('internal_user_id');
            $table->unsignedBigInteger('external_user_id')->nullable(false)->change();
        });
    }
};
