<?php


namespace App\Providers;

use App\Repositories\Contracts\ImageUploadRepositoryContract;
use App\Repositories\Contracts\PasswordResetRepositoryContract;
use App\Repositories\Contracts\StatusUpdateRepositoryContract;
use App\Repositories\Contracts\UserActivationTokenRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\ImageUploadRepository;
use App\Repositories\PasswordResetRepository;
use App\Repositories\StatusUpdateRepository;
use App\Repositories\UserActivationTokenRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(StatusUpdateRepositoryContract::class, StatusUpdateRepository::class);
        $this->app->bind(PasswordResetRepositoryContract::class, PasswordResetRepository::class);
        $this->app->bind(UserActivationTokenRepositoryContract::class, UserActivationTokenRepository::class);
        $this->app->bind(ImageUploadRepositoryContract::class, ImageUploadRepository::class);
    }

}
