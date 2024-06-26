<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            App\Repositories\Contracts\GroupRepositoryInterface::class,
            App\Repositories\GroupRepository::class
        );

        $this->app->bind(
            App\Repositories\Contracts\CategoryRepositoryInterface::class,
            App\Repositories\CategoryRepository::class
        );

        $this->app->bind(
            App\Repositories\Contracts\UserRepositoryInterface::class,
            App\Repositories\UserRepository::class
        );
        $this->app->bind(
            App\Repositories\Contracts\CommentRepositoryInterface::class,
            App\Repositories\CommentRepository::class
        );
    }
}
