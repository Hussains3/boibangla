<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderProcessed extends Mailable
{
    use Queueable, SerializesModels;

    private $order;
    private $orderProducts;
    private $discounts;
    private $totalPaymentAmount;
    private $totalDiscountAmount;
    private $totalDiscountPer;
    private $productSubTotal;
    private $deliveryChargeAmount;

    /**
     * Create a new message instance.
     *
     * @param $order
     * @param $orderProducts
     * @param $discountsArr
     * @param $totalPaymentAmount
     * @param $totalDiscountAmount
     * @param $totalDiscountPer
     * @param $productSubTotal
     * @param $deliveryChargeAmount
     */
    public function __construct($order,$orderProducts,$discountsArr,$totalPaymentAmount,$totalDiscountAmount,$totalDiscountPer, $productSubTotal, $deliveryChargeAmount)
    {
       $this->order = $order;
       $this->orderProducts = $orderProducts;
       $this->discounts = $discountsArr;
       $this->totalPaymentAmount = $totalPaymentAmount;
       $this->totalDiscountAmount = $totalDiscountAmount;
       $this->totalDiscountPer = $totalDiscountPer;
       $this->productSubTotal = $productSubTotal;
       $this->deliveryChargeAmount = $deliveryChargeAmount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       // echo $this->order->status;die;
        return $this->view('emails.customer.order-processed',[
            'order'=>$this->order,
            'orderProducts'=>$this->orderProducts,
            'discounts'=>$this->discounts,
            'totalPaymentAmount'=>$this->totalPaymentAmount,
            'totalDiscountAmount'=>$this->totalDiscountAmount,
            'totalDiscountPer'=>$this->totalDiscountPer,
            'productSubTotal'=>$this->productSubTotal,
            'deliveryChargeAmount'=>$this->deliveryChargeAmount,
        ])->subject('Your Order  #'.$this->order->order_no. ' has been '.$this->getProcessedStatus());
    }

    /**
     * This function returns the order status
     * @return string
     */
    public function getProcessedStatus()
    {
        $processStatus = '';
        if($this->order->status == 1){
            $processStatus = 'placed';
        }else if($this->order->status == 2){
            $processStatus = 'confirmed';
        }else if($this->order->status == 3){
            $processStatus = 'delivered';
        }else if($this->order->status == 4){
            $processStatus = 'canceled';
        }
        return $processStatus;
    }
}
