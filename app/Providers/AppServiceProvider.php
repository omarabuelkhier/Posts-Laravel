<?php

namespace App\Providers;

use App\Models\post;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;
use App\Policies\PostPolicy;


use PHPUnit\Event\TestRunner\BootstrapFinished;

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
