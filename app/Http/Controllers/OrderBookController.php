<?php

namespace App\Http\Controllers;

use App\Models\OrderBook;
use App\Http\Requests\StoreOrderBookRequest;
use App\Http\Requests\UpdateOrderBookRequest;

class OrderBookController extends Controller
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
     * @param  \App\Http\Requests\StoreOrderBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderBookRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderBook  $orderBook
     * @return \Illuminate\Http\Response
     */
    public function show(OrderBook $orderBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderBook  $orderBook
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderBook $orderBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderBookRequest  $request
     * @param  \App\Models\OrderBook  $orderBook
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderBookRequest $request, OrderBook $orderBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderBook  $orderBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderBook $orderBook)
    {
        //
    }
}
