<?php


namespace App\Repositories\Contracts;


interface UserRepositoryContract
{
    /**
     * @param array $data
     * @return mixed
     */
    public function registerUser(array $data);

    /**
     * @param int $userId
     * @return mixed
     */
    public function activateUser(int $userId);

    /**
     * @param $email
     * @return mixed
     */
    public function checkIfUserExistsViaEmail($email);

}
