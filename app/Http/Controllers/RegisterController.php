<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use App\Models\Category;
use App\Models\Publication;
use App\Mail\AccountCreated;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;



class RegisterController extends Controller
{


    
    /**
     * Display register page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $categories = Category::all();
        $publications = Publication::all();
        return view('auth.register',compact('categories','publications'));
    }

    // Email check
    public function mailcheck(Request $request)
    {
        if ($request->email_check) {
            $existing_email = User::where('email', $request->email)->count();
            if ( $existing_email > 0) {
                echo "taken";
            }else{
                echo "not_taken";
            }
            exit();
        }

    }

    // Phone check
    public function phonecheck(Request $request)
    {
        if ($request->phone_check) {
            $existing_phone = User::where('phone', $request->phone)->count();
            if ( $existing_phone > 0) {
                echo "taken";
            }else{
                echo "not_taken";
            }
            exit();
        }

    }




    /**
     * Handle account registration request
     *
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {


        // return $request;
        $token = Helper::generateToken();
        $createUser = User::createUser($request,$token);


        Newsletter::subscribe($createUser->email);


        try{
            Mail::to($createUser->email)->send(new AccountCreated($createUser,$token));
            session()->put('customer_id_for_verify', $createUser->id);
        }catch (\Exception $exception){}

        Auth::login($createUser);
        $role = Role::where('name','customer')->get()->first();
        $createUser->assignRole([$role->id]);
        $response =  response()->json(['status'=>'accountcreated','message' => 'Account created successfully !','link' => route('accountVerify',[$token])]);
        return $response;
    }


    public function accountVerify()
    {
        if (! $this->user()->hasVerifiedEmail()) {
            $this->user()->markEmailAsVerified();

            event(new Verified($this->user()));
        }
    }


}
