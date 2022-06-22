<?php

namespace App\Http\Controllers;

use App\Models\ComposeNewsLetter;
use App\Http\Requests\StoreComposeNewsLetterRequest;
use App\Http\Requests\UpdateComposeNewsLetterRequest;

class ComposeNewsLetterController extends Controller
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
     * @param  \App\Http\Requests\StoreComposeNewsLetterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComposeNewsLetterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComposeNewsLetter  $composeNewsLetter
     * @return \Illuminate\Http\Response
     */
    public function show(ComposeNewsLetter $composeNewsLetter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComposeNewsLetter  $composeNewsLetter
     * @return \Illuminate\Http\Response
     */
    public function edit(ComposeNewsLetter $composeNewsLetter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateComposeNewsLetterRequest  $request
     * @param  \App\Models\ComposeNewsLetter  $composeNewsLetter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComposeNewsLetterRequest $request, ComposeNewsLetter $composeNewsLetter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComposeNewsLetter  $composeNewsLetter
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComposeNewsLetter $composeNewsLetter)
    {
        //
    }
}
