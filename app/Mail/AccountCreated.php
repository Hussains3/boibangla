<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountCreated extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var User
     */
    private $user;
    private $token;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param $token
     */
    public function __construct(User $user,$token)
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
        return $this->view('emails.customer.account-created', [
            'customer'=>$this->user,'token' =>$this->token
        ])->subject('Signup completed, Please verify your account');
    }
}
