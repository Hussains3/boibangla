<?php

namespace App\Http\Controllers;

use App\Models\BookTag;
use App\Http\Requests\StoreBookTagRequest;
use App\Http\Requests\UpdateBookTagRequest;

class BookTagController extends Controller
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
     * @param  \App\Http\Requests\StoreBookTagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookTagRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookTag  $bookTag
     * @return \Illuminate\Http\Response
     */
    public function show(BookTag $bookTag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookTag  $bookTag
     * @return \Illuminate\Http\Response
     */
    public function edit(BookTag $bookTag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookTagRequest  $request
     * @param  \App\Models\BookTag  $bookTag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookTagRequest $request, BookTag $bookTag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookTag  $bookTag
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookTag $bookTag)
    {
        //
    }
}
