<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Models\CustomerAddress;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'username',
        'password',
        'profile_pic',
        'status',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Always encrypt password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }




    /**
     * This function creates new customer user
     * @param $accountRequest
     * @param $token
     * @return Collection
     */
    public static function createUser($accountRequest,$token)
    {
        // bcrypt($accountRequest->password),
        return self::create([
            'name' => $accountRequest->name,
            'email' => $accountRequest->email,
            'phone' => $accountRequest->phone,
            'username' => $accountRequest->phone,
            'password' => $accountRequest->password,
            'remember_token' => $token,
        ]);
    }

    public function addresses() {
        return $this->hasMany(Address::class,'user_id','id');
    }
    public function orders() {
        return $this->hasMany(Order::class,'user_id','id');
    }

    public function affiliation(){
        return $this->hasOne(Affiliation::class, 'user_id', 'id');
    }


    public function affiLinks(){
        return $this->hasMany(AffiliationLink::class, 'user_id', 'id');
    }

    public function affiItems(){
        return $this->hasMany(AffiliationItem::class, 'user_id', 'id');
    }




    /**
     * This function gives the current wallet balance
     * @param $userId
     * @return collection
     */
    public static function getCurrentWalletBalance($userId)
    {
        return self::select('wallet_balance')->where('user_id',$userId)->value('wallet_balance');
    }

    /**
     * This function checks if a customer has enough balance in wallet
     * @uses customer
     * @param $userId
     * @param $amountToPay
     * @return bool
     */
    public static function checkEnoughBalanceInWallet($userId,$amountToPay)
    {
        $currentBalance = self::getCurrentWalletBalance($userId);
        if ($currentBalance >= $amountToPay ){
            return true;
        }else{
            return false;
        }
    }




    public function wishlistbooks() {
        return $this->hasMany(Wishlist::class,'user_id','id')
        ->join('books','wishlists.book_id','books.id');
    }




}
