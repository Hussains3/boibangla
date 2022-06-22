<?php

namespace App\Http\Controllers;

use App\Models\PublicationDiscount;
use App\Http\Requests\StorePublicationDiscountRequest;
use App\Http\Requests\UpdatePublicationDiscountRequest;

class PublicationDiscountController extends Controller
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
     * @param  \App\Http\Requests\StorePublicationDiscountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePublicationDiscountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PublicationDiscount  $publicationDiscount
     * @return \Illuminate\Http\Response
     */
    public function show(PublicationDiscount $publicationDiscount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PublicationDiscount  $publicationDiscount
     * @return \Illuminate\Http\Response
     */
    public function edit(PublicationDiscount $publicationDiscount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePublicationDiscountRequest  $request
     * @param  \App\Models\PublicationDiscount  $publicationDiscount
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePublicationDiscountRequest $request, PublicationDiscount $publicationDiscount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PublicationDiscount  $publicationDiscount
     * @return \Illuminate\Http\Response
     */
    public function destroy(PublicationDiscount $publicationDiscount)
    {
        //
    }
}
