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
        Schema::table('modul_sektorals', function (Blueprint $table) {
            $table->json('slider_images')->nullable();
            $table->string('attachment_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modul_sektorals', function (Blueprint $table) {
            $table->dropColumn(['slider_images', 'attachment_file']);
        });
    }
};
