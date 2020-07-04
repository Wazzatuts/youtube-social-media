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
            $newReset = new PasswordReset();
            $newReset->email = $email;
            $newReset->token = Str::random(16);
            $newReset->save();

            return $newReset;

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

}
