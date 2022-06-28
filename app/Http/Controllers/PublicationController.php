<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Http\Requests\StorePublicationRequest;
use App\Http\Requests\UpdatePublicationRequest;
use App\Models\PublicationBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Book;

class PublicationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $publications = Publication::all();

        return view('dashboard.publications.publications',compact('user','publications'));
    }


    public function publicationsBooks(Request $request, $publicationSlug)
    {
        $categories = Category::all();
        $user = Auth::user();
        $publications = Publication::all();
        $publication = Publication::where('slug',$publicationSlug)->first();
        $books = $publication->books;

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


        return view('publications.show',compact('categories','user','publications','publication','books'));
    }

    /**
     * This function creates/updates the publications
     * @param StorePublicationRequest $storePublicationRequest
     * @return json
     */
    public function savePublications(StorePublicationRequest $storePublicationRequest)
    {
        $publications = Publication::savePublications($storePublicationRequest);
        return response()->json(['status'=>'success','message' => 'Publication saved successfully !']);
    }

    /**
     * This function returns all the publications
     * @param Request $request
     * @return json
     */
    public function getPublicationList(Request $request)
    {
        $publications = Publication::getPublicationList($request);
        return datatables($publications)->addIndexColumn()->make(true);
    }

    /**
     * This function deletes the publications
     * @param Request $request
     * @return json
     */
    public function deletePublication(Request $request)
    {
        $booksFound = PublicationBook::where('publication_id',$request->publicationId)->count();
        if ($booksFound == 0){
            Publication::deletePublication($request);
            $message =  response()->json(['status'=>'success','message' => 'Publication deleted successfylly !']);
        }else {
            $message = response()->json(['status' => 'error', 'message' => 'This Publication assigned in some books!']);
        }
        return $message;
    }

    /**
     * This function changes the publication to be active or in-active
     * @param Request $statusRequest
     * @return json
     */
    public function changePublicationStatus(Request $statusRequest)
    {
        Publication::where(['id'=>$statusRequest->publicationId])->update(['status'=>$statusRequest->updateStatus]);
        return response()->json(['status'=>'success','message'=>'Publication '.(($statusRequest->updateStatus==1?'activated':'de-activated')).' successfully !']);
    }
}
