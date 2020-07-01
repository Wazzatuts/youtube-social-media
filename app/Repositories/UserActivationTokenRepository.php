<?php


namespace App\Repositories;

use App\Repositories\Contracts\StatusUpdateRepositoryContract;
use App\Repositories\Contracts\UserActivationTokenRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use App\StatusUpdate;
use App\UserActivationToken;

class UserActivationTokenRepository implements UserActivationTokenRepositoryContract
{
    /**
     * @param int $userId
     * @param $token
     * @return UserActivationToken|mixed
     */
    public function createToken(int $userId, $token)
    {
        try {
            $newToken = new UserActivationToken();
            $newToken->user_id = $userId;
            $newToken->token = $token;
            $newToken->save();

            return $newToken;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * @param $code
     * @return mixed
     */
    public function checkToken($code)
    {
        try {
            $checkToken = UserActivationToken::where(['token' => $code])->first();

            return $checkToken;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

}
