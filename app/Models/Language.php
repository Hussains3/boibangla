<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
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
     * This function creates/updates the language
     * @param $languageRequest
     * @purpose admin
     * @return collection
     */
   public static function saveLanguage($languageRequest)
   {
       $languageData = [
           'name' => $languageRequest->name,
           'code'=> $languageRequest->code,
       ];
       return self::updateOrCreate(['id' => $languageRequest->editId],$languageData);
   }

    /**
     * This function returns all the languages by default active
     * @param $request
     * @purpose admin
     * @return collection
     */
   public static function getLanguageList($request)
   {
       $languageSearch = $request->languageSearch;
       return self::select('languages.id', 'languages.name','languages.code')
           ->where('languages.name', 'like','%'. $languageSearch . '%')
           ->orderBy('id', 'DESC')
           ->get();
   }

    /**
     * This function deletes the language means updates the status->3
     * @param $request
     * @purpose admin
     * @return collection
     */
    public static function deleteLanguage($request)
    {
        return self::where('id',$request->languageId)->update(['status'=>3]);
    }


    public function book() {
        return $this->hasMany(LanguageBook::class,'language_id','id')
        ->join('books','language_books.book_id','books.id');
    }
}
