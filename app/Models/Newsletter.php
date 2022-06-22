<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email','status'];

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
        'email' => 'string',
        'status' => 'int',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * This function subscribes the users
     * to our mailing list
     * @param $email
     * @return int
     */
    public static function subscribe($email)
    {
        return self::create(['email'=>$email,'status'=>1]);
    }
    /**
     * This function lists Newsletters
     * @param $listRequest
     * @return collection
     */
    public static function listSubscribers($listRequest)
    {
        $emailFilter = $listRequest->emailFilter;
        return self::select('id','email','status')
            ->when($emailFilter,function ($queryEmail) use($emailFilter){
                $queryEmail->where('email', 'like', "%$emailFilter%");
            })
            ->get();
    }
}
