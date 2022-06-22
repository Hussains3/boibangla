<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Discount extends Model
{
    use HasFactory;

    const ACTIVE = 1;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['coupon_name','discount','description','categories','start_date','validity_date','status'];

    /**
     * The attributes that aren't mass assignable.
     * @var array
     */
    protected $guarded = ['created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * fields will be Carbon-ized
     * @var array
     */
    protected $dates = ['created_at','updated_at'];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'coupon_name' => 'string',
        'discount' => 'string',
        'description' => 'string',
        'categories' => 'string',
        'start_date' => 'datetime:d-m-Y H:i:s',
        'validity_date' => 'datetime:d-m-Y H:i:s',
        'status' => 'int',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * This function returns the list of discounts
     * @param $listRequest
     * @return array
     */
    public static function listDiscount($listRequest)
    {
        $discountNameSearch = $listRequest->discountNameSearch;
        $discounts = self::select('discounts.id','discounts.coupon_name','discounts.discount','discounts.description',
            'discounts.categories','discounts.start_date','discounts.validity_date','discounts.status')
            ->when($discountNameSearch,function ($querySearch) use($discountNameSearch){
                $querySearch->where('discounts.coupon_name','like','%'.$discountNameSearch.'%');
            })
            ->orderBy('discounts.id','DESC')
            ->get();
        $tempResponse = [];
        $discountFinal = $discounts;
        foreach ($discountFinal as $discount){
            if ($discount->categories){
                $categoryNames = Category::whereIn('id',explode(',',$discount->categories))->pluck('category')->toArray();
                $discount['category_names'] = implode(',',$categoryNames);
            }else{
                $discount['category_names'] = '';
            }
            $tempResponse[] = $discount;
        }

        $finaResponse['data'] = $tempResponse;
        return $tempResponse;
    }

    /**
     * This function validates and fetches the coupon code
     * which is being applied
     * @param $couponCode
     * @return collection
     */
    public static function validateCouponCode($couponCode)
    {
        return self::select('coupon_name','categories','discount')
            ->where('coupon_name',$couponCode)
            ->active()
            ->first();
    }

    /**
     * This is a local scope for to validate the
     * coupon code expiry
     * @param $query
     */
    public function scopeActive($query)
    {
        $currentDateTime =  Carbon::now();
        $query->where('start_date', '<=', $currentDateTime)
            ->where('validity_date', '>=',$currentDateTime)
            ->where('status',self::ACTIVE);
    }
}
