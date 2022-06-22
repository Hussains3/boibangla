<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\PasswordUpdateRequest;
use App\Models\User;
use App\Helper\Helper;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChangePasswordMail;

class PasswordController extends Controller
{
    public function index()
    {
        return view('customer.password.password-setting');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $originalPassword =  $user->getAuthPassword();
        if ($request->currentPasswordStatus == 'verify'){
            if (Hash::check($request->current_password,$originalPassword)){
                $response = response()->json(['status'=>'verified','message'=>'Current password matched']);

            }else{
                $response = response()->json(['status'=>'wrong','message'=>'Current password not matched']);
            }
        }else if ($request->currentPasswordStatus == 'verified'){
            $newPassword = bcrypt($request->confirm_password);
            User::where('id',$user->id)->update(['password' => $newPassword]);
            $response = response()->json(['status'=>'success','message'=>'Password updated successfully']);
        }
        return $response;
    }

    /**
     * This function loads the password reset page
     * @return View
     */
    public function resetPassword()
    {
        return view('auth.password-reset');
    }

    /**
     * This function sends a password reset email to customer,
     * @param PasswordResetRequest $resetRequest
     * @return json
     */
    public function resetMyPassword(PasswordResetRequest $resetRequest)
    {
        $token = Helper::generateToken();
        $email = $resetRequest->reset_email;
        $user = User::where('email', $email)->first();
        $user->update(['remember_token' => $token ]);



        $resetLink = route('setupPassword',[$token]);
        try{
            Mail::to($user->email)->send(new ChangePasswordMail($user,$token));
        }catch (\Exception $exception){
            dd($exception->getMessage());
        }
        return response()->json(['status' => 'success','message' => 'Check your email, we have sent a email','link' => $resetLink]);
    }

    /**
     * This function loads a password setup page
     * @param $token
     * @return View
     */
    public function setupPassword($token)
    {
        $isTokenValid = User::where('remember_token',$token)->exists();
        if ($isTokenValid){
            return view('auth.create-new-password',['token' => $token]);
        }
        abort(404);
    }

    /**
     * This function updates new password for a customer
     * @param PasswordUpdateRequest $updateRequest
     * @return json
     */
    public function updateNewPassword(PasswordUpdateRequest $updateRequest)
    {
        $token = $updateRequest['token'];
        User::where(['remember_token' => $token])->update([
            'password' => bcrypt($updateRequest['confirm_password']),
            'remember_token' => null
        ]);
        return response()->json(['success' => true,'message' => 'Password updated successfully']);
    }
}
