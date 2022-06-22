<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CustomerAddress extends Model
{
    use HasFactory;
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','first_name','last_name','email','contact','country',
        'street_address','state','town_city','postal_code','address_type'
    ];

    /**
     * The attributes that aren't mass assignable.
     * @var array
     */
    protected $guarded = ['created_at','updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at','updated_at'];

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
        'user_id' => 'int',
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'contact' => 'string',
        'country' => 'int',
        'street_address' => 'string',
        'state' => 'string',
        'town_city' => 'string',
        'postal_code' => 'string',
        'address_type' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * This function creates/updates the address
     * @param $addressRequest
     * @return collection
     */
    public static function createUpdateAddress($addressRequest)
    {
        $userId = Auth::id();
        $data = [
            'user_id' => $userId,
            'first_name' => $addressRequest->first_name,
            'last_name' => $addressRequest->last_name,
            'email' => $addressRequest->email_address,
            'contact' => $addressRequest->address_contact,
            'country' => $addressRequest->country,
            'street_address' => $addressRequest->street_address,
            'state' => $addressRequest->state,
            'town_city' => $addressRequest->city_town,
            'postal_code' => $addressRequest->postal_zip_code,
            'address_type' => $addressRequest->address_type,
        ];
        return self::updateOrCreate(
            ['id'=>$addressRequest->edit_id],$data
        );
    }

    public static function getMyAddresses()
    {

        $userId = Auth::id();
        return self::select('customer_addresses.*','countries.name as country_name','addresses')
            ->leftjoin('countries','customer_addresses.country','countries.id')
            ->where('customer_addresses.user_id',$userId)->get();
    }

    public static function getAddressInfo($addressId)
    {
        return self::where('id',$addressId)->first();
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
    /**
     * Get the user's address name based on type
     *
     * @return string
     */
    public function getAddressNameAttribute()
    {
        if ($this->address_type == 1){
            $return =  'HOME';
        }
        if ($this->address_type == 2){
            $return =  'OFFICE';
        }
        if ($this->address_type == 3){
            $return =  'OTHER';
        }
        return "{$return}";
    }
}
