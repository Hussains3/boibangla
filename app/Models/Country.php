<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'code'];

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
        'name' => 'string',
        'code' => 'string',
    ];

    /**
     * This function creates/updates the country
     * @param $countryRequest
     * @purpose admin
     * @return collection
     */
   public static function saveCountry($countryRequest)
   {
       $countryData = [
           'country' => $countryRequest->country,
           'code'=> $countryRequest->code,
       ];
       return self::updateOrCreate(['id' => $countryRequest->editId],$countryData);
   }

    /**
     * This function returns all the countries by default active
     * @param $request
     * @purpose admin
     * @return collection
     */
   public static function getCountryList($request)
   {
       $countrySearch = $request->countrySearch;
       return self::select(
           'countries.id',
           'countries.name',
           'countries.shortname',
           'countries.phonecode'
           )
           ->when($countrySearch, function ($nameQuery) use ($countrySearch) {
               return $nameQuery->where('countries.name', 'like','%'. $countrySearch . '%');
           })
           ->orderBy('id', 'DESC')
           ->get();
   }

    /**
     * This function deletes the country means updates the status->3
     * @param $request
     * @purpose admin
     * @return collection
     */
    public static function deleteCountry($request)
    {
        return self::where('id',$request->countryId)->update(['status'=>3]);
    }

    public function book() {
        return $this->hasMany(CountryBook::class,'country_id','id')
        ->join('books','country_books.book_id','books.id');
    }

}
