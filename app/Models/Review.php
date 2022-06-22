<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Review extends Model
{
    use HasFactory;
    public $timestamps = false;
    const ACTIVE = 1;
    const ARCHIVED = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['order_id','book_id','user_id','rating','remark','review_pictures','review_date','status'];

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
    protected $dates = ['review_date'];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'order_id' => 'int',
        'book_id' => 'int',
        'user_id' => 'int',
        'rating' => 'int',
        'remark' => 'string',
        'review_pictures' => 'string',
        'review_date' => 'datetime',
        'status' => 'int',
    ];

    public function getReviewDateAttribute($value)
    {
        return date("j F,  Y",strtotime($value));
    }
    public function getFirstNameAttribute($value)
    {
        return ucwords($value);
    }
    public function getLastNameAttribute($value)
    {
        return ucwords($value);
    }


    /**
     * This function rates the book
     * @param $request
     * @param $reviewImages
     * @return bool
     */
    public static function rateBook($request)
    {
        $userId = Auth::id();
        return self::create([
            'book_id' => $request->book_id,
            'user_id' => $userId,
            'rating' => $request->ratinNumber,
            'remark' => $request->reviewDescription,
            'review_date' => date('Y-m-d H:i:s')
        ]);
    }


    /**
     * This function checks if a book can be rated
     * or it is already rated for a order id
     * @param $orderId
     * @param $bookId
     * @return bool
     */
    public static function bookCanBeRated($bookId)
    {
        $userId = Auth::id();
        $alreadyRated =  self::select('id')->where(['book_id'=>$bookId,'user_id'=>$userId])->first();
        if (!$alreadyRated){
            return true;
        }else{
            return false;
        }
    }

    /**
     * This function returns the book ids which are rated for
     * a user for a particular order Id
     * @param $orderId
     * @return array
     */
    public static function getMyRatedBooks($orderId)
    {
        $books = self::where(['order_id'=>$orderId])->pluck('book_id');
        if ($books){
            $books = $books->toArray();
        }
        return $books;
    }

    public function scopeBookReviewSelect($query)
    {
        return $query->select('reviews.id','reviews.book_id','reviews.rating','reviews.remark','reviews.review_date','reviews.status',
            'users.name')
            ->join('books','reviews.book_id','books.id')
            ->join('users','reviews.user_id','users.id');
    }

    /**
     * This function returns the book reviews
     * for the public website
     * @param $bookId
     * @return collection
     */
    public static function getBookReviews($bookId)
    {
        return self::bookReviewSelect()
            ->where('books.id',$bookId)
            ->where('reviews.status',self::ACTIVE)
            ->orderBy('reviews.id')
            ->get();
    }
    /**
     * This function returns the book reviews
     * for the admin
     * @param $bookId
     * @return collection
     */
    public static function getBookReviewss($bookId)
    {
        return self::bookReviewSelect()
            ->where('books.id',$bookId)
            ->orderBy('reviews.id')
            ->get();
    }

    /**
     * This function returns all the reviews of a customer
     * @param $userId
     * @return collection
     */
    public static function getMyAllReviews($userId)
    {
        return self::select('orders.order_no','books.book_name','books.book_slug','reviews.rating','reviews.remark','reviews.review_date')
            ->join('orders','reviews.order_id','orders.id')
            ->join('books','reviews.book_id','books.id')
            ->where('reviews.user_id',$userId)
            ->orderBy('reviews.id','DESC')
            ->paginate(10);
    }

    /**
     * This is special function called accessor to change the value
     * @param $value
     * @return string
     */
    public function getProfilePicAttribute($value)
    {
        if ($value){
            return asset('storage/uploads/profile/customer/'. $value);
        }
        return asset('assets/images/avtar/default-customer-avtar.jpg');
    }


}
