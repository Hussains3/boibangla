<?php

namespace App\Http\Controllers;

use App\Models\LanguageBook;
use App\Http\Requests\StoreLanguageBookRequest;
use App\Http\Requests\UpdateLanguageBookRequest;

class LanguageBookController extends Controller
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
     * @param  \App\Http\Requests\StoreLanguageBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLanguageBookRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LanguageBook  $languageBook
     * @return \Illuminate\Http\Response
     */
    public function show(LanguageBook $languageBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LanguageBook  $languageBook
     * @return \Illuminate\Http\Response
     */
    public function edit(LanguageBook $languageBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLanguageBookRequest  $request
     * @param  \App\Models\LanguageBook  $languageBook
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLanguageBookRequest $request, LanguageBook $languageBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LanguageBook  $languageBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(LanguageBook $languageBook)
    {
        //
    }
}
