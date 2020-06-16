<?php


namespace App\Providers;

use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\StatusUpdateRepository;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\Contracts\StatusUpdateRepositoryContract;

class RepositoryServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(StatusUpdateRepositoryContract::class, StatusUpdateRepository::class);
    }

}
