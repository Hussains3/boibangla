<?php

namespace App\Http\Controllers;

use App\Models\CategoryBook;
use App\Http\Requests\StoreCategoryBookRequest;
use App\Http\Requests\UpdateCategoryBookRequest;

class CategoryBookController extends Controller
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
     * @param  \App\Http\Requests\StoreCategoryBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryBookRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryBook  $categoryBook
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryBook $categoryBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryBook  $categoryBook
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryBook $categoryBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryBookRequest  $request
     * @param  \App\Models\CategoryBook  $categoryBook
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryBookRequest $request, CategoryBook $categoryBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryBook  $categoryBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryBook $categoryBook)
    {
        //
    }
}
