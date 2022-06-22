<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProcessing extends Model
{
    use HasFactory;
    const ORDER_PLCAED = 1;
    const CONFIRMED = 2;
    const PROCESSING = 3;
    const SHIPPED = 4;
    const DELIVERED = 5;
    const CANCELED = 6;
    const DEFAULT_REMARK = 'Order placed';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['order_id','status','remark','processing_date'];

    /**
     * The attributes that aren't mass assignable.
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * fields will be Carbon-ized
     * @var array
     */
    protected $dates = ['processing_date'];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'order_id' => 'int',
        'status' => 'int',
        'remark' => 'string',
        'processing_date' => 'date:j,F Y h:i:s A',
    ];

    public function getProcessStatusAttribute($value)
    {
        $orderStatus = '';
        if ($value == 1){
            $orderStatus = 'Ordered';
        }else if ($value == 2){
            $orderStatus = 'Confirmed';
        }else if ($value == 3){
            $orderStatus = 'Processed';
        }else if ($value == 4){
            $orderStatus = 'Shipped';
        }else if ($value == 5){
            $orderStatus = 'Delivered';
        }
        return $orderStatus;
    }

    public function setRemarkAttribute($value)
    {
        $this->attributes['remark'] = ucfirst($value);
    }

    /**
     * This function returns the order processsing history
     * @param $orderId
     * @return collection
     */
    public static function getOrderProcessing($orderId)
    {
        return self::select('order_id','status','status as process_status','processing_date','remark')->where('order_id',$orderId)->get();
    }

    public static function getDeliveredDate($orderId)
    {
        return self::where(['order_id'=>$orderId,'status'=>3])->select('processing_date')->value('processing_date');
    }
}
