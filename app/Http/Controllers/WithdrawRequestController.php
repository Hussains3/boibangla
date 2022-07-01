<?php

namespace App\Http\Controllers;

use App\Models\WithdrawRequest;
use App\Http\Requests\StoreWithdrawRequestRequest;
use App\Http\Requests\UpdateWithdrawRequestRequest;
use Illuminate\Support\Facades\Auth;

class WithdrawRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $withdrawRequests = WithdrawRequest::with('affiliation')->get();

        return view('dashboard.withdrawrequests.index',
            compact(
                'withdrawRequests'
            )
            );
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
     * @param  \App\Http\Requests\StoreWithdrawRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWithdrawRequestRequest $request)
    {
        $withdraw = new WithdrawRequest();
        $withdraw->user_id = Auth::user()->id;
        $withdraw->affiliation_id  = $request->affiliation_id;
        $withdraw->ammount = $request->ammount;
        $withdraw->status = 1;
        $withdraw->save();

        return redirect()->route('earningReport')->withSuccess(__('Request recived. We will contact you soon'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WithdrawRequest  $withdrawRequest
     * @return \Illuminate\Http\Response
     */
    public function show(WithdrawRequest $withdrawRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WithdrawRequest  $withdrawRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(WithdrawRequest $withdrawRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWithdrawRequestRequest  $request
     * @param  \App\Models\WithdrawRequest  $withdrawRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWithdrawRequestRequest $request, WithdrawRequest $withdrawRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WithdrawRequest  $withdrawRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(WithdrawRequest $withdrawRequest)
    {
        
    }
}
