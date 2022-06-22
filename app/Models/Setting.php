<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    const ACTIVE = 1;
    const INACTIVE = 2;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['setting_name', 'setting_value', 'setting_status'];

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
    protected $dates = ['created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'setting_name' => 'string',
        'setting_value' => 'string',
        'setting_status' => 'int',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];





    /**
     * This function returns the delivery charge setting
     * @return collection
     */
    public static function getDeliveryCharge()
    {
        return self::select('setting_value as delivery_charge')->where([
            'setting_name' => 'delivery_charge',
            'setting_status' => self::ACTIVE
        ])->value('delivery_charge');
    }
}
