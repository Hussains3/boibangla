<?php

namespace App\Http\Controllers;

use App\Models\BookDiscount;
use App\Http\Requests\StoreBookDiscountRequest;
use App\Http\Requests\UpdateBookDiscountRequest;

class BookDiscountController extends Controller
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
     * @param  \App\Http\Requests\StoreBookDiscountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookDiscountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookDiscount  $bookDiscount
     * @return \Illuminate\Http\Response
     */
    public function show(BookDiscount $bookDiscount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookDiscount  $bookDiscount
     * @return \Illuminate\Http\Response
     */
    public function edit(BookDiscount $bookDiscount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookDiscountRequest  $request
     * @param  \App\Models\BookDiscount  $bookDiscount
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookDiscountRequest $request, BookDiscount $bookDiscount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookDiscount  $bookDiscount
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookDiscount $bookDiscount)
    {
        //
    }
}
