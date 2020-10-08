<?php


namespace App\Repositories\Contracts;


interface PasswordResetRepositoryContract
{
    /**
     * @param $email
     * @return mixed
     */
    public function createPasswordReset($email);

    /**
     * @param $email
     * @param $token
     * @return mixed
     */
    public function checkReset($email, $token);
}
