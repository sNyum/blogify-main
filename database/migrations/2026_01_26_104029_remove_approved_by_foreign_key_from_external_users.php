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
        Schema::table('external_users', function (Blueprint $table) {
            // Drop foreign key constraint
            // Laravel usually names it table_column_foreign
            $table->dropForeign(['approved_by']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('external_users', function (Blueprint $table) {
            // Restore foreign key constraint
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }
};
