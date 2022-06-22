<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Response;

class CommonController extends Controller
{
    public function getSubCategories(Request $request)
    {
        $subCategories = SubCategory::whereIn('category_id',$request->category)->select('id','subcategory')->get();
        return response()->json(['status'=>'success','data'=>$subCategories]);
    }


    public function getSearchedBooks(Request $request)
    {
        // $searchedBooks = Book::with(['author','categories','publication'])
        // ->where('book_name','like','%'.$request.'%')
        // ->orWhere('book_slug','like','%'.$request.'%')
        // ->get();



        $searchedBooks = Book::where('book_slug','like','%'.$request->bookSearch.'%')
            ->orwhere('book_name','like','%'.$request->bookSearch.'%')
            ->take(10)->get();
        // $searchedBooks = Book::all()
        // ->take(10);



        // $broadcast->whereHas('homeClub', function($query) use ($parameterValues) {
        //     $query->where('abb', 'liverpool');
        // })->orWhereHas('awayClub', function($query) use ($parameterValues) {
        //     $query->where('abb', 'liverpool');
        // });




        // $blogs = Blog::where('title','like','%'.$search.'%')->orderBy('id')->paginate(6);
        return response()->json(['status'=>'success','data'=>$searchedBooks]);
    }

//    public function getAttributeOptions()
//    {
////       print_r($attributeId->all());die;
////        $attributeOptions = AttributeOption::select('id','option_name')
////            ->where('attribute_id',$attributeId)
////            ->get();
////        return Response::json(['status'=>'success','data'=>$attributeOptions]);
//    }

    public function storageLink()
    {
        Artisan::call('storage:link');
        Artisan::call('vendor:publish --tag=flare-config');
        echo "done";
    }


    public function getAffiliationBooks(Request $request)
    {
        $affiliatebook = Book::where('book_slug','like','%'.$request->bookSearch.'%')
            ->orwhere('book_name','like','%'.$request->bookSearch.'%')
            ->where('affiliation_status',1)
            ->take(10)->get();
        return response()->json(['status'=>'success','data'=>$affiliatebook]);
    }


}
