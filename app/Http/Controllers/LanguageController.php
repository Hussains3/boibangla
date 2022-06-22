<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        return view('dashboard.languages.index',compact('languages'));
    }



    /**
     * This function creates/updates the language
     * @param StoreLanguageRequest $languageRequest
     * @return json
     */
    public function saveLanguage(StoreLanguageRequest $storeLanguageRequest)
    {
        $language = Language::saveLanguage($storeLanguageRequest);
        if ($language){
            return response()->json(['status'=>'success','message' => 'Language saved successfylly !']);
        }
    }

    /**
     * This function returns all the languages by default active
     * @param Request $request
     * @return json
     */
    public function getLanguageList(Request $request)
    {
        $languages = Language::getLanguageList($request);
        return datatables($languages)->addIndexColumn()->make(true);
    }

    /**
     * This function deletes the language means updates the status->3
     * @param Request $request
     * @return json
     */
    public function deleteLanguage(Request $request)
    {
        $delete = Language::deleteLanguage($request);
        if ($delete){
            return response()->json(['status'=>'success','message' => 'Language deleted successfylly !']);
        }
    }
}
