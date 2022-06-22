<?php

namespace App\Http\Controllers;

use App\Models\CountryBook;
use App\Http\Requests\StoreCountryBookRequest;
use App\Http\Requests\UpdateCountryBookRequest;

class CountryBookController extends Controller
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
     * @param  \App\Http\Requests\StoreCountryBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountryBookRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CountryBook  $countryBook
     * @return \Illuminate\Http\Response
     */
    public function show(CountryBook $countryBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CountryBook  $countryBook
     * @return \Illuminate\Http\Response
     */
    public function edit(CountryBook $countryBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCountryBookRequest  $request
     * @param  \App\Models\CountryBook  $countryBook
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountryBookRequest $request, CountryBook $countryBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CountryBook  $countryBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(CountryBook $countryBook)
    {
        //
    }
}
