<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Database\Eloquent\Relations\Relation::enforceMorphMap([
            'user' => \App\Models\ExternalUser::class,
            'admin' => \App\Models\User::class,
            'system' => \App\Models\User::class,
            'chat_conversation' => \App\Models\ChatConversation::class,
            'chat_message' => \App\Models\ChatMessage::class, // Or generic system handling
        ]);
    }
}
