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

        // return $request;

        $categories = Category::all();
        $user = Auth::user();
        $authors = Author::all();
        $publications = Publication::all();

        $books = '';


        $category = Category::where('category_slug',$categorySlug)->first();

        // $books = Book::categoryBook($categorySlug);

        // return $books;
        if ($category) {
            # code...
            $books = DB::select('SELECT
                    books.*,
                    categories.id
                FROM
                    books
                    INNER JOIN
                    category_books
                    ON
                    category_books.book_id  = books.id
                    INNER JOIN
                    categories
                    ON
                        category_books.category_id  = categories.id
                    WHERE
                        categories.id  = '.$category->id
            );
        }

        $maxPrice = Book::max('sale_price');
        $minPrice = Book::min('sale_price');


        return view('categories.show',compact('category','books','categories','user','authors','publications','maxPrice','minPrice'));
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
