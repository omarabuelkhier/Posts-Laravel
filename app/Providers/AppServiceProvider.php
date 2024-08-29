<?php

namespace App\Providers;

use App\Models\post;
use App\Models\User;
use App\Rules\Policies\PostPolicy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
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
        Gate::define('update-post', function (User $user, post $post) {
            return $user->id === $post->creator_id;
        });
        Gate::policy(post::class, PostPolicy::class);

        Paginator::useBootstrap();
    }
}
