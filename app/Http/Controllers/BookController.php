<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\CategoryBook;
use App\Models\SubCategory;
use App\Models\SubCategoryBook;
use App\Models\Publication;
use App\Models\PublicationBook;
use App\Models\AuthorBook;
use App\Models\CountryBook;
use App\Models\LanguageBook;
use App\Models\Tag;
use App\Models\BookTag;
use App\Models\Review;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Helper\ResponseHelper;
use App\Models\Author;
use Illuminate\Support\Str;
use App\Http\Requests\BookUploadRequest;
use App\Models\Country;
use App\Models\Language;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Cookie;
use App\Models\Affiliation;
use App\Models\AffiliationItem;
use App\Models\Setting;

class BookController extends Controller
{
    /**
     * This function loads the index page of books
     * @return view
     */
    public function index()
    {

        $books = Book::all();
        return view('dashboard.books.index',compact('books'));
    }


    /**
     * This function loads the index page of books
     * @return view
     */
    public function bookShow($bookSlug)
    {
        $book = Book::where('book_slug',$bookSlug)->first();

        $bestSellingBook = Book::select('books.*','category_books.*','categories.*')
        ->with('author')
        ->join('category_books','books.id','=','category_books.book_id')
        ->join('categories','category_books.category_id','=','categories.id')
        ->where('categories.category_slug','=','best-seller')
        ->take(5)
        ->get();

        return view('books.show',compact('book','bestSellingBook'));
    }

    /**
     * This function loads the view to add books
     * @return view
     */
    public function addBooks()
    {
        $user = Auth::user();
        $publications = Publication::where('status',1)->select('id','name as publication_name')->get();
        $tags = Tag::all();
        $categories = Category::all();
        $authors = Author::all();
        $subCategories = SubCategory::all();
        $countries = Country::all();
        $languages = Language::all();

        return view('dashboard.books.add-books', compact(
            'publications',
            'tags',
            'categories',
            'authors',
            'subCategories',
            'user',
            'countries',
            'languages'
        ));
    }

    /**
     * This function creates/updates the book details
     * @param StoreBookRequest $storeBookRequest
     * @return json
     */
    public function createBook(StoreBookRequest $storeBookRequest)
    {

        // return $storeBookRequest;
        //print_r($storeBookRequest->all());die;
        $bookInfo = [
            'book_name' => $storeBookRequest->bookName,
            'sku' => $storeBookRequest->bookSku,
            'regular_price' => $storeBookRequest->regularPrice,
            'sale_price' => $storeBookRequest->salePrice,
            'discount' => ($storeBookRequest->salePrice * 100)/$storeBookRequest->regularPrice,
            'book_slug' => $storeBookRequest->bookSlug,
            'isbn' => $storeBookRequest->bookIsbn,
            'stock' => $storeBookRequest->bookStock,
            'quality' => $storeBookRequest->bookQuality,
            'editor' => $storeBookRequest->editor,
            'edition' => $storeBookRequest->edition,
            'number_of_pages' => $storeBookRequest->numberOfPages,
            'unit' => ucwords($storeBookRequest->bookUnit),
            'book_image' => $this->updateBookImage($storeBookRequest),
            'book_image_1' => $this->updateBookImage1($storeBookRequest),
            'book_image_2' => $this->updateBookImage2($storeBookRequest),
            'book_image_3' => $this->updateBookImage3($storeBookRequest),
            'book_image_4' => $this->updateBookImage4($storeBookRequest),
            'book_image_5' => $this->updateBookImage5($storeBookRequest),
            'description' => $storeBookRequest->bookDescription,
            'additional_info' => $storeBookRequest->additionalInfo,
            'summary' => $storeBookRequest->bookSummary,
        ];
        DB::beginTransaction();
        $book = Book::updateOrCreate(['id'=>$storeBookRequest->editId],$bookInfo);


        if ($storeBookRequest->book_tags) {
            BookTag::updateOrCreate(['book_id'=>$storeBookRequest->editId],['book_id'=>$book->id,'tag_ids'=>implode(',',$storeBookRequest->book_tags)]);
        }


        /**
         * Find out the difference b/w new coming authors,and already exist authors
         * associated with book
         */
        $authorAlready = AuthorBook::where('book_id',$book->id)->pluck('author_id')->toArray();

        if ($storeBookRequest->bookauthor) {
            $newCategories = array_diff($storeBookRequest->bookauthor,$authorAlready);
            $authorToDelete = array_diff($authorAlready,$storeBookRequest->bookauthor);
            /**
             * Finally save the authors and delete old authors
             */
            if (count($newCategories)){
                foreach ($newCategories as $author){
                    $authorBooks[] = [
                        'book_id' => $book->id,
                        'author_id' => $author,
                    ];
                }
                AuthorBook::insert($authorBooks);
            }
            if ($authorToDelete){
                AuthorBook::whereIn('author_id',$authorToDelete)->where('book_id',$book->id)->delete();
            }

        }

        /**
         * Find out the difference b/w new coming categories,and already exist categories
         * associated with book
         */
        $categoryAlready = CategoryBook::where('book_id',$book->id)->pluck('category_id')->toArray();

        if ($storeBookRequest->bookCategory) {
            $newCategories = array_diff($storeBookRequest->bookCategory,$categoryAlready);
            $categoryToDelete = array_diff($categoryAlready,$storeBookRequest->bookCategory);
            /**
             * Finally save the categories and delete old categories
             */
            if (count($newCategories)){
                foreach ($newCategories as $category){
                    $categoryBooks[] = [
                        'book_id' => $book->id,
                        'category_id' => $category,
                    ];
                }
                CategoryBook::insert($categoryBooks);
            }
            if ($categoryToDelete){
                CategoryBook::whereIn('category_id',$categoryToDelete)->where('book_id',$book->id)->delete();
            }

        }

        /**
         * Similarly, perform same logic for sub categories,filter options as in categories
         */
        if ($storeBookRequest->bookSubCategory){
            $subCategoryAlready = SubCategoryBook::where('book_id',$book->id)->pluck('sub_category_id')->toArray();
            $newSubCategories = array_diff($storeBookRequest->bookSubCategory,$subCategoryAlready);
            $subCategoryToDelete = array_diff($subCategoryAlready,$storeBookRequest->bookSubCategory);
            if (count($newSubCategories)){
                foreach ($newSubCategories as $subCategory){
                    $suCategoryBooks[] = [
                        'book_id' => $book->id,
                        'sub_category_id' => $subCategory,
                    ];
                }
                SubCategoryBook::insert($suCategoryBooks);
            }
            if ($subCategoryToDelete){
                SubCategoryBook::whereIn('sub_category_id',$subCategoryToDelete)->where('book_id',$book->id)->delete();
            }
        }

        /**
         * Find out the difference b/w new coming publications,and already exist publications
         * associated with book
         */
        $publicationsAlready = PublicationBook::where('book_id',$book->id)->pluck('publication_id')->toArray();

        if ($storeBookRequest->bookpublication){
            $newPublications = array_diff($storeBookRequest->bookpublication,$publicationsAlready);
            $publicationsToDelete = array_diff($publicationsAlready,$storeBookRequest->bookpublication);
            if (count($newPublications)){
                foreach ($newPublications as $publication){
                    $publicationBooks[] = [
                        'book_id' => $book->id,
                        'publication_id' => $publication,
                    ];
                }
                PublicationBook::insert($publicationBooks);
            }
            if ($publicationsToDelete){
                PublicationBook::whereIn('publication_id',$publicationsToDelete)->where('book_id',$book->id)->delete();
            }
        }


        /**
         * Find out the difference b/w new coming countries,and already exist countries
         * associated with book
         */
        $countryAlready = CountryBook::where('book_id',$book->id)->pluck('country_id')->toArray();

        if ($storeBookRequest->bookCountry) {
            $newCountries = array_diff($storeBookRequest->bookCountry,$countryAlready);
            $countryToDelete = array_diff($countryAlready,$storeBookRequest->bookCountry);
            /**
             * Finally save the countries and delete old countries
             */
            if (count($newCountries)){
                foreach ($newCountries as $country){
                    $countryBooks[] = [
                        'book_id' => $book->id,
                        'country_id' => $country,
                    ];
                }
                CountryBook::insert($countryBooks);
            }
            if ($countryToDelete){
                CountryBook::whereIn('country_id',$countryToDelete)->where('book_id',$book->id)->delete();
            }

        }

        /**
         * Find out the difference b/w new coming languages,and already exist languages
         * associated with book
         */
        $languageAlready = LanguageBook::where('book_id',$book->id)->pluck('language_id')->toArray();

        if ($storeBookRequest->bookLanguage) {
            $newLanguage = array_diff($storeBookRequest->bookLanguage,$languageAlready);
            $languageToDelete = array_diff($languageAlready,$storeBookRequest->bookLanguage);
            /**
             * Finally save the languages and delete old languages
             */
            if (count($newLanguage)){
                foreach ($newLanguage as $language){
                    $languageBooks[] = [
                        'book_id' => $book->id,
                        'language_id' => $language,
                    ];
                }
                LanguageBook::insert($languageBooks);
            }
            if ($languageToDelete){
                LanguageBook::whereIn('language_id',$languageToDelete)->where('book_id',$book->id)->delete();
            }

        }
        Book::setSellPrice($book->id);
        DB::commit();
        return response()->json(['status'=>'success','message' => 'Book saved successfully !']);
    }


       /**
     * This function returns the list of books
     * @param Request $listRequest
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Exception
     * @return json
     */
    public function listBooks(Request $listRequest)
    {
        $bookSearch = $listRequest->bookSearch;
        $books = Book::select('id','book_name','sku','regular_price','sale_price','stock','unit','book_image','book_image_1','book_image_2', 'book_image_3','description',
            'additional_info','average_rating','status')
            ->where('status',1)
            ->when($bookSearch,function ($searchQuery) use($bookSearch){
                $searchQuery->where('book_name','like','%'.$bookSearch.'%');
                $searchQuery->orWhere('sku','like','%'.$bookSearch.'%');
            })->orderBy('id','DESC')->get();
        return datatables($books)->addIndexColumn()->make(true);
    }

        /**
     * This function creates the data and loads the view to edit books
     * @param $bookId
     * @return view
     */
    public function editBook($bookId)
    {

        $user = Auth::user();
        $categories = Category::all();
        $authors = Author::all();
        $subCategories = SubCategory::all();
        $countries = Country::all();
        $languages = Language::all();

        $bookInfo = Book::findOrFail($bookId);
        $publications = Publication::where('status',1)->select('id','name as publication_name')->get();
        $categoryIds = CategoryBook::where('book_id',$bookId)->pluck('category_id')->toArray();
        $categoryIds = implode(',',$categoryIds);
        $subCategoriesIds = SubCategoryBook::where('book_id',$bookId)->pluck('sub_category_id')->toArray();
        $subCategoriesIds = implode(',',$subCategoriesIds);
        $publicationIds = PublicationBook::where('book_id',$bookId)->pluck('publication_id')->toArray();
        $publicationIds = implode(',',$publicationIds);
        $tags = Tag::all();
        $taggedIds = BookTag::select('tag_ids')->where('book_id',$bookId)->pluck('tag_ids')->toArray();
        $taggedIds = implode(',',$taggedIds);


        return view(
            'dashboard.books.add-books',
            [
                'bookInfo'=>$bookInfo,
                'publications'=>$publications,
                'categoryIds'=>$categoryIds,
                'subCategoryIds'=>$subCategoriesIds,
                'publicationIds'=>$publicationIds,
                'tags' => $tags,
                'taggedIds' => $taggedIds,
                'languages' => $languages,
                'countries' => $countries,
                'authors' => $authors,
                'subCategories' => $subCategories,
                'categories' => $categories
            ]
        );
    }

    public function getBooks()
    {
        $categoriesWithSubCategories = Category::with(['subCategories'])->get()->toArray();
        $publicationsWithCount = Publication::withCount('book')->get();
        return view('customer.books.books',[
            'categoriesWithSubCategories' => $categoriesWithSubCategories,'publicationsWithCount'=>$publicationsWithCount
        ]);
    }

    /**
     * This function finds all the book of a category/subcategory
     * @param $categorySlug
     * @param string $subCategorySlug
     * @param Request $request
     * @return json
     */
    public function getFilteredBook($categorySlug,$subCategorySlug = '',Request $request)
    {
        $defaultFilter = $request->default_filter;
        $ratingFilter = $request->rating_filter;

        $books = Book::select('books.id','books.book_name','categories.category_slug',
            'books.book_slug','books.regular_price','books.sale_price','books.book_image',
            'books.book_image_1','books.average_rating','books.total_reviews',
            'books.sku')->distinct()
            ->join('category_books','books.id','category_books.book_id')
            ->join('categories','category_books.category_id','categories.id')
            ->join('sub_category_books','books.id','sub_category_books.book_id')
            ->join('sub_categories','sub_category_books.sub_category_id','sub_categories.id')
            ->where('categories.category_slug',$categorySlug)
            ->when($subCategorySlug, function ($subCategory) use ($subCategorySlug) {
                return $subCategory->where('sub_categories.slug', $subCategorySlug);
            })
            ->when($defaultFilter, function ($filterQuery) use ($defaultFilter) {
                if ($defaultFilter == 'popularity'){
                    return $filterQuery->orderBy('books.average_rating','DESC');
                }else if ($defaultFilter == 'new'){
                    return $filterQuery->orderBy('books.id','DESC');
                }else if ($defaultFilter == 'price_asc'){
                    return $filterQuery->orderBy('books.regular_price','ASC');
                }else if ($defaultFilter == 'price_desc'){
                    return $filterQuery->orderBy('books.regular_price','DESC');
                }
            })
            ->when($ratingFilter, function ($ratingsQuery) use ($ratingFilter) {
                return $ratingsQuery->where('books.average_rating','<=',$ratingFilter);
            })
            ->get();
        return response()->json(['status' => 'success','data' => $books]);
    }

    /**
     * This function just loades the page after entering search query
     * @return view
     */
   /* public function searchBook()
    {
        $categoriesWithSubCategories = Category::with(['subCategories'])->get()->toArray();
        $publicationsWithCount = Publication::withCount('book')->get();
        return view('customer.books.books-search',[
            'categoriesWithSubCategories' => $categoriesWithSubCategories,'publicationsWithCount'=>$publicationsWithCount
        ]);
    }*/

    /**
     * This function is a API to get the searched books
     * based on the the search query
     * @param $categorySlug
     * @param string $searchQuery
     * @param Request $request
     * @return json
     */
   /* public function getSearchedBooks($searchQuery,Request $request)
    {
        $books = [];
        $defaultFilter = $request->default_filter;
        $ratingFilter = $request->rating_filter;
        $getTagId = Tag::select('id')->where('tag','LIKE',"%$searchQuery%")->value('id');
        $taggedBookIds = BookTag::whereRaw("FIND_IN_SET($getTagId,tag_ids)")->pluck('book_id');
        if ($taggedBookIds){
            $books = Book::select('books.id','book_name','book_name','book_slug','regular_price','sale_price','book_image',
                    'book_image_1','average_rating','total_reviews')
                ->join('category_books','books.id','category_books.book_id')
                ->whereIn('books.id',$taggedBookIds)
                ->when($defaultFilter, function ($filterQuery) use ($defaultFilter) {
                    if ($defaultFilter == 'popularity'){
                        return $filterQuery->orderBy('books.average_rating','DESC');
                    }else if ($defaultFilter == 'new'){
                        return $filterQuery->orderBy('books.id','DESC');
                    }else if ($defaultFilter == 'price_asc'){
                        return $filterQuery->orderBy('books.regular_price','ASC');
                    }else if ($defaultFilter == 'price_desc'){
                        return $filterQuery->orderBy('books.regular_price','DESC');
                    }
                })
                ->when($ratingFilter, function ($ratingsQuery) use ($ratingFilter) {
                    return $ratingsQuery->where('books.average_rating','<=',$ratingFilter);
                })
                ->get();
            return response()->json(['status' => 'success','data' => $books]);
        }

    }*/

    /**
     * This funtion loades the all tags,queries to input search
     * @param Request $request
     * @return json
     */
    public function getRelatedQueries(Request $request)
    {
        $search = $request->search;
        $queries = Tag::select('id','tag')
            ->when($search,function($query) use($search){
                return $query->where('tag','like',"%$search%");
             })->get()
            ->toArray();
        return response()->json(['status' => 'success','data' => $queries]);
    }

    /**
     * This function is a API to search the book via name or SKU
     * @param Request $request
     * @return json
     */
    public function bookSearch(Request $request)
    {
        $search = $request->search;
        if ($search){
            $books = Book::select('id','book_name','book_slug')
                ->when($search,function($query) use($search){
                    return $query->where('book_name','like',"%$search%")
                        ->orWhere('sku','like',"%$search%");
                })->get();
            return response()->json(['status' => 'success','data' => $books]);
        }
    }

    /**
     * This is a function used to get the single book details
     * @param $bookSlug
     * @return view
     */
    public function getBookDetail(Request $request,$bookSlug)
    {
        $book = Book::where('book_slug',$bookSlug)->first();
        $setSaleprice = Book::setSellPrice($book->id);
        $minutes =  36000;
        if ($request->affiliator) {
            $affiliatorID = Cookie::queue('bbaffiliator_id', $request->affiliator, $minutes);
            $bbaffiliator_book = Cookie::queue('bbaffiliator_book', $bookSlug, $minutes);
        }

        // only for test


        // only for test

        $bookTagNames = [];
        $bookDetail = Book::getBookDetail($bookSlug);
        // $bookCategory= $bookDetail->categories->first()->id;
        $bookCategory= Category::with('books')->where('id',$bookDetail->categories->first()->id)->first();

        // $simillarBooks = Book::select('books.*','category_books.*','categories.*')
        // ->join('category_books','books.id','=','category_books.book_id')
        // ->join('categories','category_books.category_id','=','categories.id')
        // ->where('categories.category_slug','=',$bookCategory->category_slug)->take(7)->get();

        $bookTaggedIds = BookTag::select('tag_ids')
            ->join('books','book_tags.book_id','books.id')
            ->where('books.book_slug',$bookSlug)
             ->value('tag_ids');

        $wishlistsbooks = '';
        $mywishlist = '';

        if (Auth::user()) {
            $wishlistsbooks = Auth::user()->wishlistbooks;
            $mywishlist = Wishlist::where('user_id', Auth::user()->id)
            ->where('book_id',$bookDetail->id)->first('id');
        }





        if ($bookTaggedIds){
            $bookTaggedIds = explode(',',$bookTaggedIds);
            $tagNames = Tag::whereIn('id',$bookTaggedIds)->pluck('tag');
            if ($tagNames){
                $bookTagNames = $tagNames->toArray();
            }
        }
        if ($bookDetail){
            $socialSharing = array(
                'url'=> route('getBookDetail',['bookSlug'=>$bookSlug]),
                'title'=>$bookDetail->book_name,
                'tags'=>'#Boibangla #Boibangla Books'
            );

            $reviews = Review::getBookReviews($bookDetail->id);
            return view('books.show',[
                'bookDetail'=>$bookDetail,
                'bookCategory'=>$bookCategory,
                'bookTagNames' => $bookTagNames,
                'socialSharing' => $socialSharing,
                // 'simillarBooks' => $simillarBooks,
                'wishlistsbooks' => $wishlistsbooks,
                'mywishlist' => $mywishlist,
                'reviews' => $reviews
            ]);
        }
        abort(404);
    }

    /**
     * This function gives the related books
     * in book detail page
     * @param $bookId
     * @return json
     */
    public static function getRelatedBooks($bookId)
    {
        $relatedBooks  = [];
        $relatedBooks = CategoryBook::select(
            'books.id',
            'books.book_name',
            'categories.category_slug',
            'books.book_slug',
            'books.regular_price',
            'books.sale_price',
            'books.book_image',
            'books.book_image_1',
            'books.book_image_2',
            'books.book_image_3',
            'books.book_image_4',
            'books.book_image_5',
            'books.average_rating',
            'books.description',
            'books.additional_info',
            'books.sku',
            'books.total_reviews'
            )
            ->join('books','category_books.book_id','books.id')
            ->join('categories','category_books.category_id','categories.id')
            ->where('books.id','!=',$bookId)
            ->groupBy('books.id')
            ->get();
        return response()->json(['status' => 'success','data' => $relatedBooks]);

    }

    /**
     * This function returns all the latest revies of the book
     * @param Request $request
     * @return json
     */
    public function getBookReviews(Request $request)
    {
        $reviews = [];
        $bookId = $request->bookId;
        $reviews = Review::getBookReviews($bookId);
        $response =  response()->json(['status' => 'success','data' => $reviews]);
        return $response;
    }


        /**
     * This function deletes the book permanently from database
     * @param Request $deleteRequest
     * @return json
     */
    public function deleteBook(Request $deleteRequest)
    {
        try {
            $bookUploadPath =  Config::get('constants.paths.bookUpload');
            DB::beginTransaction();
            CategoryBook::whereIn('book_id',explode(',',$deleteRequest->bookId))->delete();
            SubCategoryBook::whereIn('book_id',explode(',',$deleteRequest->bookId))->delete();
            PublicationBook::whereIn('book_id',explode(',',$deleteRequest->bookId))->delete();
            $bookImages = Book::where('id',$deleteRequest->bookId)
                ->select('book_image','book_image_1','book_image_2','book_image_3','book_image_4','book_image_5')
                ->first();
            @unlink($bookUploadPath.$bookImages->book_image);
            @unlink($bookUploadPath.$bookImages->book_image_1);
            @unlink($bookUploadPath.$bookImages->book_image_2);
            @unlink($bookUploadPath.$bookImages->book_image_3);
            @unlink($bookUploadPath.$bookImages->book_image_4);
            @unlink($bookUploadPath.$bookImages->book_image_5);
            Book::where('id',$deleteRequest->bookId)->delete();
            DB::commit();

        } catch (\Illuminate\Database\QueryException $e) {
            // var_dump($e->errorInfo);
            return response()->json(['status'=>'error','message' => $e->errorInfo]);

        }
        return response()->json(['status'=>'success','message' => 'Book deleted successfully !']);
    }


    /**
     * This function uploads required book image
     * @param $bookRequest
     * @scope local
     * @return string
     */
    public function updateBookImage($bookRequest)
    {
        $bookImg = $bookRequest->file('bookImage');
        if ($bookRequest->hasFile('bookImage')) {
            $bookImageName = $bookRequest->bookSlug.'-'.$bookImg->getClientOriginalName();
            $path = Config::get('constants.paths.bookUpload');
            if ($bookRequest->preBookImage !="null" && $bookRequest->preBookImage){
                @unlink($path.$bookRequest->preBookImage);
            }
            $uploadResult =  $bookImg->move($path,$bookImageName);
        }else{
            $bookImageName = $bookRequest->preBookImage;
        }
        return $bookImageName;
    }



    /**
     * This function uploads 1nd book image
     * @param $bookRequest
     * @scope local
     * @return string
     */
    public function updateBookImage1($bookRequest)
    {
        $bookImg = $bookRequest->file('otherImage1');
        if ($bookRequest->hasFile('otherImage1')) {
            $bookImageName = $bookRequest->bookSlug.'-img-1-'.$bookImg->getClientOriginalName();
            $path = Config::get('constants.paths.bookUpload');
            if ($bookRequest->preOtherImage1 !="null" && $bookRequest->preOtherImage1){
                @unlink($path.$bookRequest->preOtherImage1);
            }
            $uploadResult =  $bookImg->move($path,$bookImageName);
        }else{
            $bookImageName = $bookRequest->preOtherImage1;
        }
        return $bookImageName;
    }

    /**
     * This function uploads 2nd book image
     * @param $bookRequest
     * @scope local
     * @return string
     */
    public function updateBookImage2($bookRequest)
    {
        $bookImg = $bookRequest->file('otherImage2');
        if ($bookRequest->hasFile('otherImage2')) {
            $bookImageName = $bookRequest->bookSlug.'-img-2-'.$bookImg->getClientOriginalName();
            $path = Config::get('constants.paths.bookUpload');
            if ($bookRequest->preOtherImage2 !="null" && $bookRequest->preOtherImage2){
                @unlink($path.$bookRequest->preOtherImage2);
            }
            $uploadResult =  $bookImg->move($path,$bookImageName);
        }else{
            $bookImageName = $bookRequest->preOtherImage2;
        }
        return $bookImageName;
    }

    /**
     * This function uploads 3rd book image
     * @param $bookRequest
     * @scope local
     * @return string
     */
    public function updateBookImage3($bookRequest)
    {
        $bookImg = $bookRequest->file('otherImage3');
        if ($bookRequest->hasFile('otherImage3')) {
            $bookImageName = $bookRequest->bookSlug.'-img-3-'.$bookImg->getClientOriginalName();
            $path = Config::get('constants.paths.bookUpload');
            if ($bookRequest->preOtherImage3 !="null" && $bookRequest->preOtherImage3){
                @unlink($path.$bookRequest->preOtherImage3);
            }
            $uploadResult =  $bookImg->move($path,$bookImageName);
        }else{
            $bookImageName = $bookRequest->preOtherImage3;
        }
        return $bookImageName;
    }

    /**
     * This function uploads 3rd book image
     * @param $bookRequest
     * @scope local
     * @return string
     */
    public function updateBookImage4($bookRequest)
    {
        $bookImg = $bookRequest->file('otherImage4');
        if ($bookRequest->hasFile('otherImage4')) {
            $bookImageName = $bookRequest->bookSlug.'-img-4-'.$bookImg->getClientOriginalName();
            $path = Config::get('constants.paths.bookUpload');
            if ($bookRequest->preOtherImage4 !="null" && $bookRequest->preOtherImage4){
                @unlink($path.$bookRequest->preOtherImage4);
            }
            $uploadResult =  $bookImg->move($path,$bookImageName);
        }else{
            $bookImageName = $bookRequest->preOtherImage4;
        }
        return $bookImageName;
    }

    /**
     * This function uploads 3rd book image
     * @param $bookRequest
     * @scope local
     * @return string
     */
    public function updateBookImage5($bookRequest)
    {
        $bookImg = $bookRequest->file('otherImage5');
        if ($bookRequest->hasFile('otherImage5')) {
            $bookImageName = $bookRequest->bookSlug.'-img-5-'.$bookImg->getClientOriginalName();
            $path = Config::get('constants.paths.bookUpload');
            if ($bookRequest->preOtherImage5 !="null" && $bookRequest->preOtherImage5){
                @unlink($path.$bookRequest->preOtherImage5);
            }
            $uploadResult =  $bookImg->move($path,$bookImageName);
        }else{
            $bookImageName = $bookRequest->preOtherImage5;
        }
        return $bookImageName;
    }




    /**
     * This function shows the detailed information of a uploaded book
     * @param $bookId
     * @return view
     */
    public function getBookInfo($bookId)
    {
        $bookTags = [];
        $bookItem  = Book::where(['id'=>$bookId,'status'=>1])->first();
        $categoryIds = CategoryBook::where('book_id',$bookId)->pluck('category_id')->toArray();
        $categoryNames = Category::select('id','category')->whereIn('id',$categoryIds)->get();

        $subCategoriesId = SubCategoryBook::where('book_id',$bookId)->pluck('sub_category_id')->toArray();
        $subCategoryNames = SubCategory::select('id','subcategory')->whereIn('id',$subCategoriesId)->get();

        $publicationIds = PublicationBook::where('book_id',$bookId)->pluck('publication_id')->toArray();
        $publicationNames = Publication::select('id','name as publication_name')->whereIn('id',$publicationIds)->get();

        $taggedIds = BookTag::where('book_id',$bookId)->select('tag_ids')->value('tag_ids');
        if ($taggedIds){
            $bookTags = Tag::getTags(explode(',',$taggedIds));
            if ($bookTags){
                $bookTags = $bookTags->toArray();
            }
        }
       return view('dashboard.books.book-info',['bookItem'=>$bookItem,
           'categories'=>$categoryNames,'subCategories'=>$subCategoryNames,
           'publications'=>$publicationNames,'bookTags' =>$bookTags
       ]);
    }

    /**
     * This function uploads books in bulk from CSV file
     * @param BookUploadRequest $uploadRequest
     * @return json
     */
   public function uploadBook(BookUploadRequest $uploadRequest)
   {
       if ($uploadRequest->hasFile('book_file')) {
           $handle = fopen($_FILES['book_file']['tmp_name'], "r");
           $count = 0;
           DB::beginTransaction();
           while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
               $count++;
               if ($count == 1) {continue;}
               $categories = $data[6];
               $subCategories = $data[7];
               $publications = $data[8];
               $book = Book::create([
                   'book_name' => $data[0],
                   'sku' => $data[1],
                   'regular_price' =>$data[2],
                   'sale_price' =>  $data[3],
                   'book_slug' => Str::slug($data[0]),
                   'stock' => $data[4],
                   'unit' => ucwords($data[5]),
                   'book_image' => $data[10],
                   'book_image_1' => $data[11],
                   'book_image_2' => $data[12],
                   'book_display'=>  $data[9],
                   'description' => $data[13],
               ]);

               if ($categories){
                   $categories = explode(',',$categories);
                   foreach ($categories as $category){
                       CategoryBook::create([
                           'book_id' => $book->id,
                           'category_id' => $category,
                       ]);
                   }
               }
               if ($subCategories){
                   $subCategories = explode(',',$subCategories);
                   foreach ($subCategories as $subCategory){
                        SubCategoryBook::create([
                            'book_id' => $book->id,
                            'sub_category_id' => $subCategory,
                        ]);
                   }
               }
               if ($publications){
                   $publications = explode(',',$publications);
                   foreach ($publications as $publication){
                       PublicationBook::create([
                           'book_id' => $book->id,
                           'publication_id' => $publication,
                       ]);
                   }
               }
           }
           DB::commit();
           $this->uploadBookImagesInBulk($uploadRequest);
           return response()->json(['status'=>'success','message' => 'Books uploaded successfully !']);
       }
   }

    /**
     * This function uploads the book images in bulk
     * of that CSV which is being uploaded
     * @param $uploadRequest
     * @return bool
     */
   public function uploadBookImagesInBulk($uploadRequest)
   {
       $upload = false;
        if ($uploadRequest->hasFile('book_images')){
            $path = Config::get('constants.paths.bookUpload');
            foreach ($uploadRequest->file('book_images') as $bookImage){
                $imageName = $bookImage->getClientOriginalName();
                $result = $bookImage->move($path,$imageName);
                if ($result){
                    $upload = true;
                }
            }
        }
        return $upload;
   }

    /**
     * This function loads the review page for a book
     * @param $bookId
     * @return View
     */
   public function bookReviews($bookId)
   {
       $book = Book::findOrFail($bookId,['book_name']);
       return view('dashboard.books.book-reviews', compact('bookId', 'book'));
   }

    /**
     * This function lists all the reviews of a book
     * @param $bookId
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Exception
     */
   public function listBookReviews($bookId)
   {
       $reviews = Review::getBookReviewss($bookId);
       return datatables($reviews)->addIndexColumn()->make(true);
   }

    /**
     * This function deletes the book review
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
   public function archiveBookReview(Request $request)
   {
       try{
           /*$review = Review::findOrFail($reviewId,['review_pictures']);
           $reviewPictures = $review->review_pictures;
           if ($reviewPictures){
               $reviewPictures = explode(',',$reviewPictures);
               $path = Config::get('constants.paths.book_review');
               foreach ($reviewPictures as $reviewPicture){
                   @unlink($path . $reviewPicture);
               }
          }*/
           $bookId = $request->book_id;
           Review::where('id', $request->id)->update(['status' => Review::ARCHIVED]);
           Book::updateAverageRating($bookId);
           Book::whereId($bookId)->decrement('total_reviews');
           return ResponseHelper::successResponse(__('Review deleted successfully'));
       }catch (\Exception $exception) {
           return ResponseHelper::errorResponse($exception->getMessage(),201);
       }
   }
}
