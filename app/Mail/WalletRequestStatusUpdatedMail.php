<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WalletRequestStatusUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;
    private $walletRequest;
    private $status;

    /**
     * Create a new message instance.
     *
     * @param $walletRequest
     * @param $status
     */
    public function __construct($walletRequest, $status)
    {
        $this->walletRequest = $walletRequest;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.customer.wallet-request-status-updated',[
            'walletRequest' => $this->walletRequest,
            'status' => $this->status
        ])->subject('Your wallet request status has been updated' );
    }
}
