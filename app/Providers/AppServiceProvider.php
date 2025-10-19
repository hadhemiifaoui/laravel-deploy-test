<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\TaskRepository;
use App\Repositories\TaskRepositoryInterface;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\UserRepository;


class AppServiceProvider extends ServiceProvider
{
   
    public function register(): void
    {
         $this->app->bind(
            TaskRepositoryInterface::class,
            TaskRepository::class
         );
         $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    
    public function boot(): void
    {
        //
    }
}
