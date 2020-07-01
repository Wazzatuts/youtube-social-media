<?php


namespace App\Repositories\Contracts;


interface UserActivationTokenRepositoryContract
{
    /**
     * @param int $userId
     * @param $token
     * @return mixed
     */
    public function createToken(int $userId, $token);

    /**
     * @param $code
     * @return mixed
     */
    public function checkToken($code);

}
