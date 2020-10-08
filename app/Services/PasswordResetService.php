<?php


namespace App\Services;


use App\Repositories\Contracts\PasswordResetRepositoryContract;

class PasswordResetService
{
    /**
     * @var PasswordResetRepositoryContract
     */
    protected $passwordResetRepositoryContract;

    /**
     * PasswordResetService constructor.
     * @param PasswordResetRepositoryContract $passwordResetRepositoryContract
     */
    public function __construct(PasswordResetRepositoryContract $passwordResetRepositoryContract)
    {
        $this->passwordResetRepositoryContract = $passwordResetRepositoryContract;
    }

    public function createPasswordReset($email)
    {
        return $this->passwordResetRepositoryContract->createPasswordReset($email);
    }

    public function checkReset($email, $token)
    {
        return $this->passwordResetRepositoryContract->checkReset($email, $token);
    }


}
