<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Publication;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $categories = Category::all();
        $categoriesIcons = Helper::iconLibrary();
        return view('dashboard.categories.index',compact('categories','categoriesIcons','user'));
    }



    public function categoryShow(Request $request, $categorySlug)
    {
        $category = Category::where('category_slug',$categorySlug)->first();
        $categories = Category::all();
        $user = Auth::user();
        $authors = Author::all();
        $publications = Publication::all();
        $books = $category->books;

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



        return view('categories.show',compact('category','books','categories','user','authors','publications'));
    }

    /**
     * This function creates/updates the category
     * @param StoreCategoryRequest $categoryRequest
     * @return json
     */
    public function saveCategory(StoreCategoryRequest $storeCategoryRequest)
    {
        $category = Category::saveCategory($storeCategoryRequest);
        if ($category){
            return response()->json(['status'=>'success','message' => 'Category saved successfylly !']);
        }
    }


    /**
     * This function returns all the categories by default active
     * @param Request $request
     * @return json
     */
    public function getCategoryList(Request $request)
    {
        $categories = Category::getCategoryList($request);
        return datatables($categories)->addIndexColumn()->make(true);
    }

    /**
     * This function deletes the category means updates the status->3
     * @param Request $request
     * @return json
     */
    public function deleteCategory(Request $request)
    {
        $delete = Category::deleteCategory($request);
        if ($delete){
            return response()->json(['status'=>'success','message' => 'Category deleted successfylly !']);
        }
    }
}
