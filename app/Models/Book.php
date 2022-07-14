<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryBook;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    use HasFactory;
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'book_name',
        'book_slug',
        'sku',
        'isbn',
        'edition',
        'editor',
        'number_of_pages',
        'summary',
        'average_rating',
        'quality',
        'regular_price',
        'sale_price',
        'bookQuality',
        'stock',
        'unit',
        'book_image',
        'book_image_1',
        'book_image_2',
        'book_image_3',
        'book_image_4',
        'book_image_5',
        'book_display',
        'description',
        'additional_info',
        'average_rating',
        'total_reviews',
        'status'
    ];

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


    protected $with = ['author'];
    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'book_name' => 'string',
        'book_slug' => 'string',
        'sku' => 'string',
        'stock' => 'integer',
        'unit' => 'string',
        'book_image' => 'string',
        'book_image_1' => 'string',
        'book_image_2' => 'string',
        'book_image_3' => 'string',
        'book_image_4' => 'string',
        'book_image_5' => 'string',
        'description' => 'string',
        'additional_info' => 'string',
        'average_rating' => 'decimal:2',
        'total_reviews' => 'int',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    /**
     * This function returns the single book page-details
     * @param $bookSlug
     * @return collection
     */
    public static function getBookDetail($bookSlug)
    {
        return self::select(
            'id',
            'book_name',
            'book_slug',
            'edition',
            'editor',
            'number_of_pages',
            'isbn',
            'summary',
            'book_slug',
            'book_slug',
            'sku',
            'regular_price',
            'sale_price',
            'stock',
            'quality',
            'book_image',
            'book_image_1',
            'book_image_2',
            'book_image_3',
            'book_image_4',
            'book_image_5',
            'description',
            'additional_info',
            'average_rating'
            )
            ->with(['author','publication','categories','languages','countries','languages'])
            ->where('status',1)
            ->where('book_slug',$bookSlug)
            ->first();
    }

    /**
     * This function updates the average rating of the book
     * each time when a customer gives review
     * @param $bookId
     * @return int
     */
    public static function updateAverageRating($bookId)
    {
        $averageRating = Review::where(['book_id'=>$bookId, 'status' => Review::ACTIVE])->avg('rating');
        return self::where('id',$bookId)->update(['average_rating'=>$averageRating]);
    }

    /**
     * This function updates the total reviews count for a book
     * each time when a book is reviewed and rated
     * @param $bookId
     * @return int
     */
    public static function updateReviewCount($bookId)
    {
       return self::whereId($bookId)->increment('total_reviews');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'category_books');
    }

    public function author() {
        return $this->hasMany(AuthorBook::class,'book_id','id')
          ->join('authors','author_books.author_id','authors.id');
    }

    public function publication() {
        return $this->hasMany(PublicationBook::class,'book_id','id')
          ->join('publications','publication_books.publication_id','publications.id');
    }
    public function languages() {
        return $this->hasMany(LanguageBook::class,'book_id','id')
          ->join('languages','language_books.language_id','languages.id');
    }
    public function countries() {
        return $this->hasMany(CountryBook::class,'book_id','id')
          ->join('countries','country_books.country_id','countries.id');
    }


    public function tag() {
        return $this->hasMany(BookTag::class,'book_id','id')
          ->join('tags','book_tags.tag_id','tags.id');
    }


    public static function setSellPrice($bookId)
    {
        $book = Book::where('id',$bookId)->first();
        $categoriDiscounts = [];
        $publicationDiscount = [];
        $authorDiscount = [];

        $bookCategories = $book->categories;
        $bookPublication = $book->publication;
        $bookAuthors = $book->author;

        foreach ($bookCategories as $category) {
            array_push($categoriDiscounts, $category->discount);
        }
        foreach ($bookPublication as $publication) {
            array_push($publicationDiscount, $publication->discount);
        }
        foreach ($bookAuthors as $author) {
            array_push($authorDiscount, $author->discount);
        }

        if (!empty($categoriDiscounts)) {
            $cd = max($categoriDiscounts);
        }else {
            $cd = 0;
        }
        if (!empty($publicationDiscount)) {
            $pd = max($publicationDiscount);
        }else {
            $pd = 0;
        }
        if (!empty($authorDiscount)) {
            $ad = max($authorDiscount);
        }else {
            $ad = 0;
        }

        $par = max($cd,$pd,$ad);

        $value = $book->regular_price;
        if ($par >= 0) {
            $nsp = $value-(($par/100)*$value);
            $book->sale_price = $nsp;
            $book->discount = $par;
            $book->save();
        }
        return $book->sale_price;
    }


    public static function categoryBook($categorySlug)
    {
        $category  = Category::where('category_slug', $categorySlug)->pluck('id')->first();
        return $category;
    }








}
