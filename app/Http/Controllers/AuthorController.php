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

    public function authorBooks(Request $request, $authorSlug)
    {
        $categories = Category::all();
        $user = Auth::user();
        $publications = Publication::all();
        $author = Author::where('slug',$authorSlug)->first();
        $books = $author->books;

        if ($request->bprice) {
            switch ($request->bprice) {
                case '1':
                    $books = $books->where('sale_price','<',100);
                    break;
                case '2':
                    $books = $books->where('sale_price','>=',100)->where('sale_price','<=',500);
                    break;
                case '3':
                    $books = $books->where('sale_price','>=',501)->where('sale_price','<=',1000);
                    break;
                case '4':
                    $books = $books->where('sale_price','>=',1001)->where('sale_price','<=',2000);
                    break;
                case '5':
                    $books = $books->where('sale_price','>',2000);
                    break;
            }
        }

        if ($request->bdiscount) {
            switch ($request->bdiscount) {
                case '1':
                    $books = $books->where('discount','<',20);
                    break;
                case '2':
                    $books = $books->where('discount','>=',21)->where('discount','<=',40);
                    break;
                case '3':
                    $books = $books->where('discount','>=',41)->where('discount','<=',60);
                    break;
                case '4':
                    $books = $books->where('discount','>=',61)->where('discount','<=',80);
                    break;
                case '5':
                    $books = $books->where('discount','>',80);
                    break;
            }
        }

        return view('authors.show',compact('author','categories','user','publications','books'));
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
