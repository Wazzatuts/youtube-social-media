<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterUserMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    protected $user;
    /**
     * @var
     */
    protected $token;

    /**
     * RegisterUserMail constructor.
     * @param $user
     * @param $token
     */
    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = url('api/users/activate_email/' . $this->token);
        return $this->from('wazza@youtube.com')->view('mail.register_user')->with([
            'name' => $this->user->name,
            'url' => $url
        ]);
    }
}
