<?php

namespace App\Http\Controllers;

use App\Models\OrderProcessing;
use App\Http\Requests\StoreOrderProcessingRequest;
use App\Http\Requests\UpdateOrderProcessingRequest;

class OrderProcessingController extends Controller
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
     * @param  \App\Http\Requests\StoreOrderProcessingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderProcessingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderProcessing  $orderProcessing
     * @return \Illuminate\Http\Response
     */
    public function show(OrderProcessing $orderProcessing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderProcessing  $orderProcessing
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderProcessing $orderProcessing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderProcessingRequest  $request
     * @param  \App\Models\OrderProcessing  $orderProcessing
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderProcessingRequest $request, OrderProcessing $orderProcessing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderProcessing  $orderProcessing
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderProcessing $orderProcessing)
    {
        //
    }
}
