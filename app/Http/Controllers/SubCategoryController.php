<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use Symfony\Component\HttpFoundation\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Author;
use App\Models\Publication;

class SubCategoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $categories = Category::select('id','category')->where('status',1)->get();
        return view('dashboard.sub-category.sub-categories',compact('categories','user'));
    }

    /**
     * This function creates/updates the sub category
     * @param SubCategoryRequest $subCategoryRequest
     * @return json
     */
    public function saveSubCategory(StoreSubCategoryRequest $storeSubCategoryRequest)
    {
        $category = SubCategory::saveSubCategory($storeSubCategoryRequest);
        if ($category){
            return response()->json(['status'=>'success','message' => 'Category saved successfylly !']);
        }
    }

    public function showSubCategory(Request $request, $slug)
    {

        // return $request;



        $subcategory = SubCategory::where('slug',$slug)->first();
        $category = $subcategory->category;
        $categories = Category::all();
        $user = Auth::user();
        $authors = Author::all();
        $publications = Publication::all();
        $books = $subcategory->books;

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



        return view('subcategories.show',compact('subcategory','category','books','categories','user','authors','publications'));
    }

    /**
     * This function returns all the sub categories
     * @param Request $request
     * @return json
     */
    public function getSubCategoryList(Request $request)
    {
        $subCategories = SubCategory::getSubCategoryList($request);
        return datatables($subCategories)->addIndexColumn()->make(true);
    }

    /**
     * This function deletes the sub category
     * @param Request $request
     * @return json
     */
    public function deleteSubCategory(Request $request)
    {
        $delete = SubCategory::deleteSubCategory($request);
        if ($delete){
            return response()->json(['status'=>'success','message' => 'Sub Category deleted successfylly !']);
        }
    }
}
