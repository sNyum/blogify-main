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
        Schema::create('chat_conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('external_user_id')->constrained('external_users')->onDelete('cascade');
            $table->foreignId('assigned_admin_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('status', ['open', 'assigned', 'closed'])->default('open');
            $table->string('subject')->nullable();
            $table->enum('priority', ['low', 'normal', 'high'])->default('normal');
            $table->integer('rating')->nullable(); // 1-5
            $table->text('feedback')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
            
            $table->index('external_user_id');
            $table->index('assigned_admin_id');
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_conversations');
    }
};
