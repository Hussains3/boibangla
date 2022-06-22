<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangePasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    private $customer;
    private $token;

    /**
     * Create a new message instance.
     *
     * @param $customer
     * @param $token
     */
    public function __construct($user,$token)
    {
        $this->customer = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.customer.password-reset-template', [
            'customer'=>$this->customer,'token' => $this->token
        ])->subject('Password Reset ');
    }
}
