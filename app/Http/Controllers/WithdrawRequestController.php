<?php

namespace App\Http\Controllers;

use App\Models\WithdrawRequest;
use App\Http\Requests\StoreWithdrawRequestRequest;
use App\Http\Requests\UpdateWithdrawRequestRequest;
use App\Models\Affiliation;
use Illuminate\Http\Request;
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
        $ifPendingExist = WithdrawRequest::where('user_id',Auth::id())->where('status',1)->count();
        if ($ifPendingExist > 0) {
            return redirect()->route('earningReport')->withSuccess(__('Sorry!. You already have a pending request. We are working on it'));
        }
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
    public function show(Request $request)
    {
        $wrq = WithdrawRequest::with('affiliation')->where('id',$request->id)->first();

        return view('dashboard.withdrawrequests.show',
            compact(
                'wrq'
            )
            );
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
    public function update(UpdateWithdrawRequestRequest $request)
    {
        $withdrawRequest = WithdrawRequest::with('affiliation')->where('id',$request->id)->first();

        if ($request->note) {
            $withdrawRequest->note = $request->note;
        }
        if ($request->status) {
            $withdrawRequest->status = $request->status;
        }

        if ($request->ammount) {
            $affiliation = Affiliation::find($withdrawRequest->affiliation_id);
            $affiliation->balance -= $request->ammount;
            $affiliation->save();
        }

        $withdrawRequest->save();

        return redirect()->route('withdraws.index')->withSuccess(__('Informatin updated'));
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
