<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WalletRequestReceived extends Mailable
{
    use Queueable, SerializesModels;
    private $data;
    private $wallerRequestId;
    private $customer;

    /**
     * Create a new message instance.
     *
     * @param $data
     * @param $wallerRequestId
     * @param $customer
     */
    public function __construct($data,$wallerRequestId, $customer)
    {
        $this->data = $data;
        $this->wallerRequestId = $wallerRequestId;
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.admin.wallet-request-received',[
            'data' => $this->data,
            'wallerRequestId' => $this->wallerRequestId,
            'customer' => $this->customer,
        ])
            ->subject('Wallet request received');
    }
}
