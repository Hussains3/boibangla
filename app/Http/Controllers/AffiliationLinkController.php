<?php

namespace App\Http\Controllers;

use App\Models\AffiliationLink;
use App\Http\Requests\StoreAffiliationLinkRequest;
use App\Http\Requests\UpdateAffiliationLinkRequest;
use Illuminate\Support\Facades\Auth;

class AffiliationLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAffiliationLinkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAffiliationLinkRequest $request)
    {
        $link = new AffiliationLink();
        $link->user_id = Auth::user()->id;
        $link->book_id = $request->bookID;
        $link->link = $request->link;
        $link->save();

        if ($link) {
            return response()->json(['status' => 'success']);
        }else {
            return response()->json(['status' => 'Something wrong']);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AffiliationLink  $affiliationLink
     * @return \Illuminate\Http\Response
     */
    public function show(AffiliationLink $affiliationLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AffiliationLink  $affiliationLink
     * @return \Illuminate\Http\Response
     */
    public function edit(AffiliationLink $affiliationLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAffiliationLinkRequest  $request
     * @param  \App\Models\AffiliationLink  $affiliationLink
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAffiliationLinkRequest $request, AffiliationLink $affiliationLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AffiliationLink  $affiliationLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(AffiliationLink $affiliationLink)
    {
        //
    }
}
