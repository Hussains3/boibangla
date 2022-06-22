<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Publication;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Country;


class CountryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $countries = Country::all();
        $countriesIcons = Helper::iconLibrary();
        return view('dashboard.countries.index',compact('countries','countriesIcons','user'));
    }



    public function countryShow($countrySlug)
    {
        $countries = Country::all();
        $user = Auth::user();
        $authors = Author::all();
        $publications = Publication::all();



        $country = Country::where('country_slug',$countrySlug)->first();
        $books = DB::select('SELECT
                books.*,
                countries.id
            FROM
                books
                INNER JOIN
                country_books
                ON
                country_books.book_id  = books.id
                INNER JOIN
                countries
                ON
                    country_books.country_id  = countries.id
                WHERE
                    countries.id  = '.$country->id
        );

        return view('countries.show',compact('country','books','countries','user','authors','publications'));
    }

    /**
     * This function creates/updates the country
     * @param StoreCountryRequest $countryRequest
     * @return json
     */
    public function saveCountry(StoreCountryRequest $storeCountryRequest)
    {
        $country = Country::saveCountry($storeCountryRequest);
        if ($country){
            return response()->json(['status'=>'success','message' => 'Country saved successfylly !']);
        }
    }

    /**
     * This function returns all the countries by default active
     * @param Request $request
     * @return json
     */
    public function getCountryList(Request $request)
    {
        $countries = Country::getCountryList($request);
        return datatables($countries)->addIndexColumn()->make(true);
    }

    /**
     * This function deletes the country means updates the status->3
     * @param Request $request
     * @return json
     */
    public function deleteCountry(Request $request)
    {
        $delete = Country::deleteCountry($request);
        if ($delete){
            return response()->json(['status'=>'success','message' => 'Country deleted successfylly !']);
        }
    }
}
