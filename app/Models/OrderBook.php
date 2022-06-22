<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderBook extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['order_id','book_id','quantity'];

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
    protected $dates = [];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'order_id' => 'int',
        'book_id' => 'int',
        'quantity' => 'int',
    ];

    public static function getOrderBookDetail($orderId,$userId='')
    {
        return self::select('books.id','books.book_name','order_books.quantity','order_books.price','books.sku')
            ->join('orders','order_books.order_id','orders.id')
            ->join('books','order_books.book_id','books.id')
            ->where('order_books.order_id',$orderId)
            /**
             * Apply user id, when using this from customer order detail
             */
            ->when($userId, function ($userQuery) use ($userId) {
                return $userQuery->where('orders.user_id',$userId);
            })
            ->get();
    }
}
