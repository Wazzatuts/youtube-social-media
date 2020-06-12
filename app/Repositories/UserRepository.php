<?php


namespace App\Repositories;


use App\Repositories\Contracts\UserRepositoryContract;
use App\User;

class UserRepository implements UserRepositoryContract
{
    public function registerUser(array $data)
    {
        try {
            $newUser = new User();
            $newUser->fill($data);
            $newUser->save();

            return $newUser;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
