<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliation extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'affiliate_id',
        'referred_by',
        'status',
        'payee_name',
        'payment_mode',
        'pan',
        'country',
        'state',
        'city',
        'zip',
        'balance',
        'rete',
    ];





    public function user(){
        return $this->belongsTo(User::class);
    }
}
