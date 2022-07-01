<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Helper\Helper;
use App\Mail\AccountCreated;
use App\Models\Address;
use App\Models\Affiliation;
use App\Models\AffiliationLink;
use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\Publication;
use App\Models\Newsletter;
use App\Models\Wishlist;
use App\Models\WithdrawRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalCustomers = User::count();
        $totalUser = User::count();
        $totalCategories = Category::count();
        $totalBooks = Book::count();
        $totalOrders = Order::count();
        $totalNewsletters = Newsletter::count();
        $totalCollection = Order::sum('payment_amount');
        $totalCodOrder = Order::where('payment_method',2)->count();
        return view('dashboard.index',compact(
            'user',
            'totalCustomers',
            'totalUser',
            'totalCategories',
            'totalBooks',
            'totalOrders',
            'totalNewsletters',
            'totalCollection',
            'totalCodOrder'
        ));
    }

    public function myaccount()
    {
        $categories = Category::all();
        $publications = Publication::all();
        $user = Auth::user();
        return view('profile.myaccount',compact('categories','publications','user'));
    }


    public function editmyaccount()
    {
        $categories = Category::all();
        $publications = Publication::all();
        $user = Auth::user();
        return view('profile.editmyaccount',compact('categories','publications','user'));
    }


    public function customerWishlist()
    {
        $categories = Category::all();
        $publications = Publication::all();
        $wishlistsbooks = Auth::user()->wishlistbooks;
        $wishlists = Wishlist::with('book')->where('user_id', Auth::user()->id)->get();
        return view('profile.my-wishlist',compact('categories','publications','wishlistsbooks','wishlists'));
    }
    public function changePassword()
    {
        $categories = Category::all();
        $publications = Publication::all();
        $user = Auth::user();
        return view('profile.change-password',compact('categories','publications','user'));
    }

    public function customerAddresses()
    {
        $addresses = Address::getMyAddresses();
        $categories = Category::all();
        $publications = Publication::all();
        return view('profile.my-addresses',compact('categories','publications','addresses'));
    }




    public function customerReview()
    {
        $categories = Category::all();
        $publications = Publication::all();
        return view('profile.my-reviews',compact('categories','publications'));
    }

    // dashboard orders
    public function customerOrders()
    {
        $myOrders = Order::getMyOrders(Auth::id());

        return view('profile.my-orders',compact('myOrders'));

    }

    // dashboard orders
    public function affiliatorLinks()
    {
        $user = User::find(Auth::id())
        ->with(['affiLinks','affiliation'])->first();
        $links = AffiliationLink::where('user_id',Auth::user()->id)->get();
        return view('profile.affiliats.links',compact('user','links'));

    }


    public function affiliatorProduct()
    {
        $user = User::find(Auth::id())
        ->first();
        return view('profile.affiliats.productReport',compact('user'));

    }


    public function earningReport()
    {
        $user = User::find(Auth::id())->first();
        $affiliation = Affiliation::where('user_id',Auth::id())->first();
        $pendingReqiest = WithdrawRequest::where('user_id', Auth::id())->where('status', 1)->get();
        return view('profile.affiliats.earningReport',compact('user','affiliation','pendingReqiest'));

    }



















    public function resendMail ($id)
    {
        $customer   = User::findOrFail($id);
        $token = Helper::generateToken();
        Mail::to($customer->email)->send(new AccountCreated($customer,$token));
    //    return json_encode('success');
        return redirect()->back()->with('show-success-alert', 'success');
    }
}
