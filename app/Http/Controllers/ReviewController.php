<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Book;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::getMyAllReviews(Auth::id());
        return view('customer.book-rating.rate-book',['reviews' => $reviews]);
    }


    /**
     * This function rates the book,updates the avg rating.
     * @param BookReviewRequest $reviewRequest
     * @return json
     */
    public function rateBook(StoreReviewRequest $reviewRequest)
    {


        if (Review::bookCanBeRated($reviewRequest->book_id)){
             DB::beginTransaction();
             Review::rateBook($reviewRequest);
             Book::updateAverageRating($reviewRequest->book_id);
             Book::updateReviewCount($reviewRequest->book_id);
             DB::commit();
            $response =  response()->json(['status'=>'success','message' => 'Book rated successfully']);
        }else{
            $response =  response()->json(['status'=>'already_rated','message' => 'Book already rated']);
        }
        return $response;
    }

    /**
     * This function uploads required book image
     * @param $reviewRequest
     * @return string
     * @scope local
     */
    // public function updateBookReviewImages($reviewRequest)
    // {
    //     $pictures = '';
    //     if ($reviewRequest->hasFile('book_pictures')) {
    //         foreach ($reviewRequest->book_pictures as $picture) {
    //             $imageName = strtolower(Str::random(5).'.'.$picture->getClientOriginalExtension());
    //             $picture->storeAs('/public/uploads/books-reviews/', $imageName);
    //             $pictures .= $imageName.',';
    //         }
    //         $pictures = rtrim($pictures,',');
    //     }
    //     return $pictures;
    // }


}
