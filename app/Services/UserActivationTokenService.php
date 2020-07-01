<?php


namespace App\Services;


use App\Repositories\Contracts\UserActivationTokenRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Support\Str;

class UserActivationTokenService
{
    /**
     * @var UserActivationTokenRepositoryContract
     */
    protected $activationTokenRepositoryContract;
    /**
     * @var UserRepositoryContract
     */
    protected $userRepositoryContract;

    /**
     * UserActivationTokenService constructor.
     * @param UserActivationTokenRepositoryContract $activationTokenRepositoryContract
     * @param UserRepositoryContract $userRepositoryContract
     */
    public function __construct(UserActivationTokenRepositoryContract $activationTokenRepositoryContract, UserRepositoryContract $userRepositoryContract)
    {
        $this->activationTokenRepositoryContract = $activationTokenRepositoryContract;
        $this->userRepositoryContract = $userRepositoryContract;
    }

    public function createNewToken(int $userId)
    {
        $token = Str::random(16);

        return $this->activationTokenRepositoryContract->createToken($userId, $token);
    }

    public function checkToken($code)
    {
        $checkToken = $this->activationTokenRepositoryContract->checkToken($code);

        if ($checkToken) {
            $userId = $checkToken->user_id;

            $this->userRepositoryContract->activateUser($userId);

            $checkToken->delete();

            return "User has been activated";
        }

        return "User has not been activated";

    }

}
