<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;


class Author extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'photo', 'discount', 'description','status'];

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
        'slug' => 'string',
        'photo' => 'string',
        'description' => 'string',
        'status' => 'int',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * This function creates/updates the author
     * @param $authorRequest
     * @purpose admin
     * @return collection
     */
   public static function saveAuthor($authorRequest)
   {
       $authorData = [
           'name' => $authorRequest->name,
           'slug'=> $authorRequest->slug,
           'photo'=> self::updateAuthorImage($authorRequest),
           'description' => $authorRequest->description,
           'discount' => $authorRequest->discount
       ];

       $updateOrCreateAuthore  = self::updateOrCreate(['id' => $authorRequest->editId],$authorData);

       if ( $authorRequest->editId) {
        $auhor = Author::find($authorRequest->editId);
        foreach ($auhor->books as $book) {
            Book::setSellPrice($book->id);
        }
       }
       return $updateOrCreateAuthore ;
   }

    /**
     * This function returns all the authors by default active
     * @param $request
     * @purpose admin
     * @return collection
     */
   public static function getAuthorList($request)
   {
       $authorSearch = $request->authorSearch;
       return self::select(
           'authors.id',
           'authors.name',
           'authors.description',
           'authors.slug',
           'authors.discount',
           'authors.status',
           'authors.photo as pimage'
           )
           ->where('authors.name', 'like','%'. $authorSearch . '%')
           ->orderBy('id', 'DESC')
           ->get();
   }

    /**
     * This function deletes the author means updates the status->3
     * @param $request
     * @purpose admin
     * @return collection
     */
   public static function deleteAuthor($request)
   {
       return self::where('id',$request->authorId)->update(['status'=>3]);
   }




    // public function books() {
    //     return $this->hasMany(AuthorBook::class,'author_id','id')
    //       ->join('books','author_books.book_id','books.id');
    // }

    public function books()
    {
        return $this->belongsToMany(Book::class,'author_books');
    }



    /**
     * This function uploads required book image
     * @param $bookRequest
     * @scope local
     * @return string
     */
    public static function updateAuthorImage($authorRequest)
    {
        $authorImg = $authorRequest->file('photo');
        if ($authorRequest->hasFile('photo')) {
            $authorImageName = $authorRequest->slug.'-'.$authorImg->getClientOriginalName();
            $path = Config::get('constants.paths.authorUpload');
            if ($authorRequest->preAuthorImage !="null" && $authorRequest->preAuthorImage){
                @unlink($path.$authorRequest->preAuthorImage);
            }
            $uploadResult =  $authorImg->move($path,$authorImageName);
        }else{
            $authorImageName = $authorRequest->preAuthorImage;
        }
        return $authorImageName;
    }
}
