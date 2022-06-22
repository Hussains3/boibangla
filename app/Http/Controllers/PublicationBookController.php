<?php

namespace App\Http\Controllers;

use App\Models\PublicationBook;
use App\Http\Requests\StorePublicationBookRequest;
use App\Http\Requests\UpdatePublicationBookRequest;

class PublicationBookController extends Controller
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
     * @param  \App\Http\Requests\StorePublicationBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePublicationBookRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PublicationBook  $publicationBook
     * @return \Illuminate\Http\Response
     */
    public function show(PublicationBook $publicationBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PublicationBook  $publicationBook
     * @return \Illuminate\Http\Response
     */
    public function edit(PublicationBook $publicationBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePublicationBookRequest  $request
     * @param  \App\Models\PublicationBook  $publicationBook
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePublicationBookRequest $request, PublicationBook $publicationBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PublicationBook  $publicationBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(PublicationBook $publicationBook)
    {
        //
    }
}
