<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountCreated;
use App\Helper\Helper;
use Barryvdh\Debugbar\Facades\Debugbar;

class SocialController extends Controller
{
    //Facebook
    public function facebookRedirect()
    {
        # code...
        return Socialite::driver('facebook')->stateless()->redirect();
    }

    public function loginWithFacebook()
    {   $user = Socialite::driver('facebook')->stateless()->user();
        if ($user ) {

            // dd($user);
            $isUser = User::where('facebook_id', $user->id)->first();
            $isUserEmail = User::where('email', $user->email)->first();


            if ($isUser || $isUserEmail) {
                Debugbar::info($isUser);
                Debugbar::info($isUserEmail);
                Auth::login($isUser);
                return redirect()
                ->route('home.index');
            }else{
                // return $user;
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id' => $user->id,
                    'user_type' => 4,
                ]);



                $accountRequest = $user;
                $token = Helper::generateToken();
                $customer = Customer::createCustomer($createUser->id,$accountRequest);
                Newsletter::subscribe($customer->email);
                Mail::to($customer->email)->send(new AccountCreated($customer,$token));
                Auth::login($createUser);
                return redirect()->route('viewCustomerDashboard');
            }
        }else{
            return redirect()->route('viewSignup');

        }
    }



    // //Google
    public function googleRedirect()
    {
        # code...
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function loginWithGoogle()
    {
        $user = Socialite::driver('google')->stateless()->user();

        if ($user ) {
            $isUser = User::where('google_id', $user->id)->first();
            $isUserEmail = User::where('email', $user->email)->first();


            if ($isUser || $isUserEmail) {
                Debugbar::info($isUser);
                Debugbar::info($isUserEmail);
                Auth::login($isUser);
                return redirect()
                ->route('viewCustomerDashboard');
            }else{
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'user_type' => 4,
                ]);




                $accountRequest = $user;
                $token = Helper::generateToken();
                $customer = Customer::createCustomer($createUser->id,$accountRequest);
                Newsletter::subscribe($customer->email);
                Mail::to($customer->email)->send(new AccountCreated($customer,$token));
                Auth::login($createUser);
                return redirect()->route('viewCustomerDashboard');
            }
        } else {
            //throw $th;
            return redirect()->route('viewSignup');
        }
    }
}
