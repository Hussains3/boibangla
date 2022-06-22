<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Category;
use App\Models\Publication;
use App\Helper\Helper;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;
use App\Models\Book;

class AuthorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $authors = Author::all();
        return view('dashboard.authors.index',compact('authors','user'));
    }

    public function customerAuthors()
    {
        $categories = Category::all();
        $user = Auth::user();
        $authors = Author::all();
        $publications = Publication::all();

        return view('authors.index',compact('authors','categories','user','publications'));
    }

    public function authorBooks($authorSlug)
    {
        $categories = Category::all();
        $user = Auth::user();
        $publications = Publication::all();

        $author = Author::with('books')
        ->where('slug',$authorSlug)->first();

        $maxPrice = Book::max('sale_price');
        $minPrice = Book::min('sale_price');



        return view('authors.show',compact('author','categories','user','publications','maxPrice','minPrice'));
    }


    /**
     * This function creates/updates the author
     * @param StoreAuthorRequest $authorRequest
     * @return json
     */
    public function saveAuthor(StoreAuthorRequest $storeAuthorRequest)
    {
        $author = Author::saveAuthor($storeAuthorRequest);
        if ($author){
            return response()->json(['status'=>'success','message' => 'Author saved successfylly !']);
        }
    }

    /**
     * This function returns all the authors by default active
     * @param Request $request
     * @return json
     */
    public function getAuthorList(Request $request)
    {
        $authors = Author::getAuthorList($request);
        return datatables($authors)->addIndexColumn()->make(true);
    }

    /**
     * This function deletes the category means updates the status->3
     * @param Request $request
     * @return json
     */
    public function deleteAuthor (Request $request)
    {
        $delete = Author::deleteAuthor ($request);
        if ($delete){
            return response()->json(['status'=>'success','message' => 'Author deleted successfylly !']);
        }
    }

    /**
     * This function changes the author to be active or in-active
     * @param Request $statusRequest
     * @return json
     */
    public function changeAuthorStatus(Request $statusRequest)
    {
        Author::where(['id'=>$statusRequest->authorID])->update(['status'=>$statusRequest->updateStatus]);
        return response()->json(['status'=>'success','message'=>'Author '.(($statusRequest->updateStatus==1?'activated':'de-activated')).' successfully !']);
    }
}
