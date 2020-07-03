<?php


namespace App\Services;


use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Support\Facades\Auth;

class UserService
{
    protected $userRepositoryContract;

    public function __construct(UserRepositoryContract $userRepositoryContract)
    {
        $this->userRepositoryContract = $userRepositoryContract;
    }

    public function registerUser(array $data)
    {
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ];

        $newUser = $this->userRepositoryContract->registerUser($userData);

        return $newUser;
    }

    public function loginUser(array $data)
    {
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = Auth::user();
            return $user;
        }

        return false;
    }

    public function checkUserIsActivated($email)
    {
        $checkIfUserExists = $this->userRepositoryContract->checkIfUserExistsViaEmail($email);

        if ($checkIfUserExists && $checkIfUserExists->email_verified_at) {
            return true;
        }
        return false;
    }

}
