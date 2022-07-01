<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Affiliation;

class WithdrawRequest extends Model
{
    use HasFactory;


    public function affiliation()
    {
        return $this->belongsTo(Affiliation::class,'affiliation_id','id');
    }
}
