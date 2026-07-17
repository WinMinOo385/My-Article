<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //  
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        //NOTE : Gate ကိုပြန်သုံးရင် $user ထည့်ပေးစရာမလိုဘူး၊ Laravel ကသူ့ဘာသာထည့်တတ်တယ်။

        Gate::define('comment-delete', function($user, $comment) {
            return $user->id == $comment->user_id;
        });

        Gate::define('article-delete', function($user, $article){
            return $user->id == $article->creator_id;
        });

        Gate::define('article-edit', function ($user, $article){
            return $user->id == $article->creator_id;
        });
    }
}
