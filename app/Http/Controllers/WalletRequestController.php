<?php

namespace App\Http\Controllers;

use App\Models\WalletRequest;
use App\Http\Requests\StoreWalletRequestRequest;
use App\Http\Requests\UpdateWalletRequestRequest;

class WalletRequestController extends Controller
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
     * @param  \App\Http\Requests\StoreWalletRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWalletRequestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WalletRequest  $walletRequest
     * @return \Illuminate\Http\Response
     */
    public function show(WalletRequest $walletRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WalletRequest  $walletRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(WalletRequest $walletRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWalletRequestRequest  $request
     * @param  \App\Models\WalletRequest  $walletRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWalletRequestRequest $request, WalletRequest $walletRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WalletRequest  $walletRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(WalletRequest $walletRequest)
    {
        //
    }
}
