<?php


namespace App\Services;


use App\Repositories\Contracts\PasswordResetRepositoryContract;
use App\Repositories\Contracts\StatusUpdateRepositoryContract;
use Illuminate\Support\Facades\Auth;

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


}
