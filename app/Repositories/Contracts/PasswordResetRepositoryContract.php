<?php


namespace App\Repositories\Contracts;


interface PasswordResetRepositoryContract
{
    /**
     * @param $email
     * @return mixed
     */
    public function createPasswordReset($email);
}
