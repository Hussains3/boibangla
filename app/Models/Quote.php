<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','organization_name','phone','book_list'];






    /**
     * This function creates/updates book quotes
     * @param $quoteRequest
     * @return Collection
     */
    public static function saveQuote($quoteRequest)
    {

        
        $book_list = $quoteRequest->file('book_list');

        if ($quoteRequest->hasFile('book_list')) {
            $quoteBookListName =  $quoteRequest->quoteSlug.'-'.$book_list->getClientOriginalName();
            $path = storage_path('app/public/uploads/quotes/');
            if ($quoteRequest->prePublicationLogo !="null" && $quoteRequest->prePublicationLogo){
                @unlink($path.$quoteRequest->prePublicationLogo);
            }
            $book_list->move($path, $quoteBookListName);
        }else{
            $quoteBookListName = $quoteRequest->prePublicationLogo;
        }

        $quoteData = [
            'name' => $quoteRequest->name,
            'organization_name'=> $quoteRequest->organization_name,
            'phone' => $quoteRequest->phone,
            'book_list' => $quoteRequest->book_list
        ];





        return self::updateOrCreate(['id' => $quoteRequest->editId],$quoteData);
    }
}
