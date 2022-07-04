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

        $bestseller = Category::with('books')
        ->where('category_slug','best-seller')->first();
        $awardwiner = Category::with('books')
        ->where('category_slug','award-wining')->first();
        $shishuKishor = Category::with('books')
        ->where('category_slug','shishu-kishor')->first();
        $sienceFiction = Category::with('books')
        ->where('category_slug','sience-fiction')->first();
        $newCollection = Category::with('books')
        ->where('category_slug','new-collection')->first();
        $preeOrdeer = Category::with('books')
        ->where('category_slug','pre-ordeer')->first();
        $siries = Category::with('books')
        ->where('category_slug','serise-book')->first();


        $islamic = Category::with('books')
        ->where('category_slug','islamic-book')->first();
        $shomokalin = Category::with('books')
        ->where('category_slug','shomokalin')->first();
        $children = Category::with('books')
        ->where('category_slug','shishu-children')->first();
        $bmb = Category::with('books')
        ->where('category_slug','bongobondhu')->first();
        $otherreligious = Category::with('books')
        ->where('category_slug','otherreligious')->first();
        $translated  = Category::with('books')
        ->where('category_slug','translated')->first();
        $political  = Category::with('books')
        ->where('category_slug','political')->first();
        $bcs  = Category::with('books')
        ->where('category_slug','bcs')->first();
        $mtc  = Category::with('books')
        ->where('category_slug','math-science-technology')->first();
        $admition  = Category::with('books')
        ->where('category_slug','admition')->first();


        // need special caare
        $lmbsbooks = Category::with('books')
        ->where('category_slug','lmbsbooks')->first();

        $banners = Media::where('type',1)->where('status',1)->get();


        return view('index',compact(
            'cartCollection',
            'categories',
            'authors',
            'bestseller',
            'awardwiner',
            'shishuKishor',
            'sienceFiction',
            'newCollection',
            'preeOrdeer',
            'siries',
            'islamic',
            'shomokalin',
            'children',
            'lmbsbooks',
            'bmb',
            'otherreligious',
            'translated',
            'political',
            'bcs',
            'mtc',
            'admition',
            'banners'
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
    public function customerbookrequest(){return view('bookrequest');}


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
        // $filePath = public_path($request->file_url);
        return response()->download($request->file_url);
    }


    public function bookSearchAffiliat(Request $request)
    {
        # code...
    }





}
