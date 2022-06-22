<?php

namespace App\Http\Controllers;

use App\Models\AffiliationItem;
use App\Http\Requests\StoreAffiliationItemRequest;
use App\Http\Requests\UpdateAffiliationItemRequest;

class AffiliationItemController extends Controller
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
     * @param  \App\Http\Requests\StoreAffiliationItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAffiliationItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AffiliationItem  $affiliationItem
     * @return \Illuminate\Http\Response
     */
    public function show(AffiliationItem $affiliationItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AffiliationItem  $affiliationItem
     * @return \Illuminate\Http\Response
     */
    public function edit(AffiliationItem $affiliationItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAffiliationItemRequest  $request
     * @param  \App\Models\AffiliationItem  $affiliationItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAffiliationItemRequest $request, AffiliationItem $affiliationItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AffiliationItem  $affiliationItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(AffiliationItem $affiliationItem)
    {
        //
    }
}
