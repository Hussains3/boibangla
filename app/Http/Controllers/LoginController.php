<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\Login\RememberMeExpiration;
use App\Models\Category;
use App\Models\Publication;

class LoginController extends Controller
{
    use RememberMeExpiration;

    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        $categories = Category::all();
        $publications = Publication::all();
        return view('auth.login',compact('categories','publications'));
    }

    /**
     * Handle account login request
     *
     * @param LoginRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {

        // $getUserForResendMail   = User::where('username', $request->username)->first();
        // if ($getUserForResendMail)
        // {
        //     $getUserCustomerId  = Customer::where('user_id', $getUserForResendMail->id)->first();
        //     Session::put('customer_id_for_verify', $getUserCustomerId->id);
        // }

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [$fieldType => $request->username,'password'=>$request->password];

        if (Auth::attempt($credentials)){
            $response =  response()->json(['status'=>'success']);
        }else{
            $response =  response()->json(['status'=>'failed']);
        }
        return $response;


        // $credentials = $request->getCredentials();

        // if(!Auth::validate($credentials)):
        //     return redirect()->to('login')
        //         ->withErrors(trans('auth.failed'));
        // endif;

        // $user = Auth::getProvider()->retrieveByCredentials($credentials);

        // Auth::login($user, $request->get('remember'));

        // if($request->get('remember')):
        //     $this->setRememberMeExpiration($user);
        // endif;

        // return $this->authenticated($request, $user);
    }

    /**
     * Handle response after user authenticated
     *
     * @param Request $request
     * @param Auth $user
     *
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended();
    }
}
