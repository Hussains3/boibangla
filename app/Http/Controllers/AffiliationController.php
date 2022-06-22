<?php

namespace App\Http\Controllers;

use App\Models\Affiliation;
use App\Http\Requests\StoreAffiliationRequest;
use App\Http\Requests\UpdateAffiliationRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AffiliationController extends Controller
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
     * @param  \App\Http\Requests\StoreAffiliationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAffiliationRequest $request)
    {
        $affiliatorExist = Affiliation::Where('user_id',Auth::id())->first();

        if ($affiliatorExist) {
            return redirect()->route('myaccount');
        }else{
            $affiliation = Affiliation::create([
                'user_id' => Auth::id(),
                'affiliate_id' => uniqid(),
                'status' => 1,
                'rank' => 1
            ]);

            $role = Role::where('name','affiliator')->get()->first();
            Auth::user()->assignRole([$role->id]);
            return redirect()->route('myaccount');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Affiliation  $affiliation
     * @return \Illuminate\Http\Response
     */
    public function show(Affiliation $affiliation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Affiliation  $affiliation
     * @return \Illuminate\Http\Response
     */
    public function edit(Affiliation $affiliation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAffiliationRequest  $request
     * @param  \App\Models\Affiliation  $affiliation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAffiliationRequest $request, Affiliation $affiliation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Affiliation  $affiliation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Affiliation $affiliation)
    {
        //
    }
}
