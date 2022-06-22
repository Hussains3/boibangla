<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Media;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->referrer) {
            setcookie('bbreferrer_id', $request->referrer, time() + (86400 * 25), "/");
        }

        $cartCollection = \Cart::getContent();
        $categories = Category::all();
        $authors = Author::all();
        $bestSellingBook = Book::select('books.*','category_books.*','categories.*')->join('category_books','books.id','=','category_books.book_id')->join('categories','category_books.category_id','=','categories.id')->where('categories.category_slug','=','best-seller')->orderBy('books.id', 'DESC')->take(8)->get();
        $awardWiningBook = Book::select('books.*','category_books.*','categories.*')->join('category_books','books.id','=','category_books.book_id')->join('categories','category_books.category_id','=','categories.id')->where('categories.category_slug','=','award-wining')->orderBy('books.id', 'DESC')->take(8)->get();
        $shishuKishorBook = Book::select('books.*','category_books.*','categories.*')->join('category_books','books.id','=','category_books.book_id')->join('categories','category_books.category_id','=','categories.id')->where('categories.category_slug','=','shishu-kishor')->orderBy('books.id', 'DESC')->take(8)->get();
        $sienceFictionBook = Book::select('books.*','category_books.*','categories.*')->join('category_books','books.id','=','category_books.book_id')->join('categories','category_books.category_id','=','categories.id')->where('categories.category_slug','=','sience-fiction')->orderBy('books.id', 'DESC')->take(8)->get();
        $newCollectionBook = Book::select('books.*','category_books.*','categories.*')->join('category_books','books.id','=','category_books.book_id')->join('categories','category_books.category_id','=','categories.id')->where('categories.category_slug','=','new-collection')->orderBy('books.id', 'DESC')->take(8)->get();
        $preeOrdeerBook = Book::select('books.*','category_books.*','categories.*')->join('category_books','books.id','=','category_books.book_id')->join('categories','category_books.category_id','=','categories.id')->where('categories.category_slug','=','pre-ordeer')->orderBy('books.id', 'DESC')->take(8)->get();
        $siriesBook = Book::select('books.*','category_books.*','categories.*')->join('category_books','books.id','=','category_books.book_id')->join('categories','category_books.category_id','=','categories.id')->where('categories.category_slug','=','serise-book')->orderBy('books.id', 'DESC')->take(8)->get();
        $banners = Media::where('type',1)->where('status',1)->get();

        return view('index',compact(
            'categories',
            'authors',
            'bestSellingBook',
            'awardWiningBook',
            'shishuKishorBook',
            'sienceFictionBook',
            'newCollectionBook',
            'preeOrdeerBook',
            'siriesBook',
            'banners',
            'cartCollection'
        ));
    }


    public function aboutUS()
    {

        $cartCollection = \Cart::getContent();
        $categories = Category::all();
        $publications = Publication::all();
        $books = Book::with('categories')->get();

        $authors = Author::all();

        return view('about',compact(
            'categories',
            'publications',
            'books',
            'authors',
            'cartCollection'));
    }



    public function privacyPolicies()
    {
        $categories = Category::all();
        $publications = Publication::all();
        $books = Book::with('categories')->get();

        $authors = Author::all();

        return view('privacy',compact('categories','publications','books','authors'));
    }



    public function termsOfUse()
    {
        $categories = Category::all();
        $publications = Publication::all();
        $books = Book::with('categories')->get();

        $authors = Author::all();

        return view('terms',compact('categories','publications','books','authors'));
    }


    public function returnPolicy(){return view('return');}
    public function aboutAffiliat(){return view('affiliats.about');}
    public function paymentAffiliat(){return view('affiliats.payment');}
    public function termsAffiliat(){return view('affiliats.termsCondition');}
    public function secureshoping(){return view('secure-shopping');}
    public function copyrigttpolicy(){return view('copywrite-policy');}
    public function payment(){return view('payment');}
    public function shipping(){return view('shipping');}
    public function faq(){return view('faq');}
    public function getQuote() {return view('quote');}
    public function contactUs(){return view('contact-us');}
    public function customerbookrequest(){return view('bookRequest');}


    public function sitemap(){
        $categories= Category::all()->take(10);
        $publications = Publication::all();
        return view('sitemap',compact('categories','publications'));
    }

    public function bookSearch(Request $request)
    {
        $bookResults = Book::limit(10)
        ->orderBy('id','DESC')
        ->get();
        return response()->json(['status'=>'found','data'=>$bookResults]);
    }


    public function fileDownload(Request $request)
    {
        // return $request;
        $filePath = public_path($request->file_url);
        return response()->download($filePath);
    }


    public function bookSearchAffiliat(Request $request)
    {
        # code...
    }





}
