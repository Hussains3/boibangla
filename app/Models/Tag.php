<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tag','slug'];

    /**
     * The attributes that aren't mass assignable.
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * fields will be Carbon-ized
     * @var array
     */
    protected $dates = [];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'tag' => 'string',
        'slug' => 'string',
    ];

    /**
     * This function lists the product tags
     * @param $listRequest
     * @purpose : admin
     * @return collection
     */
    public static function listTags($listRequest)
    {
        $tagFilter = $listRequest->tag_filter;
        return self::select('tags.id','tags.tag')
            ->when($tagFilter,function ($queryName) use($tagFilter){
                $queryName->where('tags.tag', 'like', "%$tagFilter%");
            })
            ->get();
    }

    /**
     * This function returns the tags name against
     * multiple tag Ids
     * @param $tagIds
     * @purpose : admin
     * @return collection
     */
    public static function getTags($tagIds)
    {
        return self::whereIn('id',$tagIds)->select('tag')->pluck('tag');
    }


    public function book() {
        return $this->belongsToMany(BookTag::class,'tag_id','id')
          ->join('books','book_tags.book_id','books.id');
    }
}
