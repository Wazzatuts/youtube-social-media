<?php


namespace App\Repositories;

use App\Repositories\Contracts\StatusUpdateRepositoryContract;
use App\Repositories\Contracts\UserActivationTokenRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use App\StatusUpdate;
use App\UserActivationToken;

class UserActivationTokenRepository implements UserActivationTokenRepositoryContract
{
    public function createToken(int $userId, $token)
    {
        try{
            $newToken = new UserActivationToken();
            $newToken->user_id = $userId;
            $newToken->token = $token;
            $newToken->save();

            return $newToken;
        }catch (\Exception $e){
            dd($e->getMessage());
        }
    }

}
