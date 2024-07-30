<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        Gate::define('create-post', function (User $user) {
            return Auth::check();
        });

        Gate::define('edit-post', function (User $user, Post $post) {
            return $user->isAdmin() || $user->id === $post->author_id;
        });

        Gate::define('delete-post', function (User $user, Post $post) {
            return $user->isAdmin() || $user->id === $post->author_id;
        });

        Gate::define('list-users', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('remove-users', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('make-admin', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('revoke-admin', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('isAdmin', function (User $user) {
            return $user->isAdmin();
        });
    }
}
