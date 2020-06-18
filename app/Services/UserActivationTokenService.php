<?php


namespace App\Services;


use App\Repositories\Contracts\UserActivationTokenRepositoryContract;
use Illuminate\Support\Str;

class UserActivationTokenService
{
    protected $activationTokenRepositoryContract;

    public function __construct(UserActivationTokenRepositoryContract $activationTokenRepositoryContract)
    {
        $this->activationTokenRepositoryContract = $activationTokenRepositoryContract;
    }

    public function createNewToken(int $userId)
    {
        $token = Str::random(16);

        return $this->activationTokenRepositoryContract->createToken($userId, $token);
    }

}
