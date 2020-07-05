<?php


namespace App\Repositories;

use App\PasswordReset;
use App\Repositories\Contracts\PasswordResetRepositoryContract;
use Illuminate\Support\Str;

class PasswordResetRepository implements PasswordResetRepositoryContract
{
    public function createPasswordReset($email)
    {
        try {
            $newReset = PasswordReset::updateOrCreate(
                ['email' => $email],
                [
                    'email' => $email,
                    'token' => Str::random(16),
                ]
            );

            return $newReset;

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

}
