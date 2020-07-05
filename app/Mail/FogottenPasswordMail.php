<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FogottenPasswordMail extends Mailable
{
    use Queueable, SerializesModels;


    protected $passwordResetData;

    /**
     * FogottenPasswordMail constructor.
     * @param $passwordResetData
     */
    public function __construct($passwordResetData)
    {
        $this->passwordResetData = $passwordResetData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = url('api/users/forgotPassword/' . $this->passwordResetData->token);
        return $this->from('wazza@youtube.com')->view('mail.forgotten_password')->with([
            'email' => $this->passwordResetData->email,
            'url' => $url
        ]);
    }
}
