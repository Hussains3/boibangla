<?php

namespace App\Http\Controllers;

use App\Models\AffiliatorApplication;
use App\Http\Requests\StoreAffiliatorApplicationRequest;
use App\Http\Requests\UpdateAffiliatorApplicationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\Affiliation;
use Illuminate\Support\Facades\Mail;
use App\Mail\AffiliationAcceptMail;
use Illuminate\Http\Request;

class AffiliatorApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = AffiliatorApplication::with('applicant')->get();
        return view('dashboard.affiliatorapplications.index',
            compact(
                'applications'
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
     * @param  \App\Http\Requests\StoreAffiliatorApplicationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAffiliatorApplicationRequest $request)
    {


        $user_id = Auth::user()->id;

        $application = new AffiliatorApplication();
        $application->user_id = $user_id;
        $application->save();

        return redirect()->route('myaccount')
            ->withSuccess(__('Applied successfully'));


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AffiliatorApplication  $affiliatorApplication
     * @return \Illuminate\Http\Response
     */
    public function show(AffiliatorApplication $affiliatorApplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AffiliatorApplication  $affiliatorApplication
     * @return \Illuminate\Http\Response
     */
    public function edit(AffiliatorApplication $affiliatorApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAffiliatorApplicationRequest  $request
     * @param  \App\Models\AffiliatorApplication  $affiliatorApplication
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAffiliatorApplicationRequest $request, AffiliatorApplication $affiliatorApplication)
    {
        $user = User::find($request->user_id);
        $role = Role::where('name','affiliator')->get()->first();
        $user->assignRole([$role->id]);

        $applications = AffiliatorApplication::find($request->id);
        $applications->delete();

        $random = substr(mt_rand(),0,5);
        $uniquenumber = strtoupper('bb').$random;

        $affiexist = Affiliation::where('user_id',$user->id)->first();

        // return $affiexist;
        if (!$affiexist) {
            # code...
            $affiliation = Affiliation::create([
                'user_id' => $user->id,
                'affiliate_id' => $uniquenumber,
                'status' => 2,
                'rank' => 1
            ]);
        }

        $affiliator = [
            'name'=> $user->name,
            'email'=> $user->email,
            'affiliationID' => $uniquenumber
        ];

        try {
            $mail = Mail::to($affiliator['email'])->send(new AffiliationAcceptMail($affiliator));
            // return $affiliator;
            return redirect()->route('affiliationapplication.index')->withSuccess(__('Application Approved'));
        }catch (\Exception $exception){}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AffiliatorApplication  $affiliatorApplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(AffiliatorApplication $affiliatorApplication, Request $request)
    {
        $application = AffiliatorApplication::find($request->applicationID);
        $application->delete();
        // return $application;

        return redirect()->route('affiliationapplication.index')
            ->withSuccess(__('Application declined'));
    }
}
