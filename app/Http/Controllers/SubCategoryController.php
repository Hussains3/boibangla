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

        $categories = Category::all();
        $user = Auth::user();
        $authors = Author::all();
        $publications = Publication::all();

        $books = '';


        $subcategory = SubCategory::where('slug',$slug)->first();
        $maxPrice = Book::max('sale_price');
        $minPrice = Book::min('sale_price');


        return view('subcategories.show',compact('subcategory','books','categories','user','authors','publications','maxPrice','minPrice'));
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
